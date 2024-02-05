<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Auth;
use App\Models\Reimbursement;
use App\Models\ReimbursementDetail;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ReimbursementController extends Controller
{
    //
    public function index(){
        

        if(Auth::user()->department->nama_departemen == "HR"){
            
            $data = Reimbursement::orderBy('status')->get();
            return view('/hr-reimbursement', ['reimbursement' => $data]);

        } elseif(Auth::user()->department->nama_departemen == "FINANCE") {
            
            $data = Reimbursement::where(function($query){
                $query->where('status', '=', 'accepted')
                      ->orWhere('status', '=', 'claimed');
            })->orderBy('status')->get();
            return view('/fin-reimbursement', ['reimbursement' => $data]);

        } else {

            $data = Reimbursement::where('id_user', Auth::user()->nip)->get()->map(function ($item) {
                $item->tanggal = $item->created_at->format('d F Y');
                return $item;
            });

            return view('reimbursement', ['reimbursement' => $data] );

        }

        
    }

    public function claimFormFilled($id){
        
        $data = Reimbursement::where('id', $id)->first();

        if($data == null){
            return redirect('/reimbursement');
        }

        if(Auth::user()->department->nama_departemen == "HR"){
            
            return view('hr-claim-form-filled', ['detail' => $data] );

        } elseif(Auth::user()->department->nama_departemen == "FINANCE") {
            
            return view('fin-claim-form-filled', ['detail' => $data] );

        } else {

            return view('claim-form-filled', ['detail' => $data] );

        }

    }

    public function claimForm(){
        return view('claim-form');
    }

    public function claim(Request $request){
        try{
            DB::transaction(function () use ($request){

                $request->validate([
                    'kategori' => 'required',
                    'from' => 'required',
                    'to' => 'required',
                    'bukti' => 'required|mimes:zip,rar'
                ]);

                $reimbursementValue = [
                    'id_user' => Auth::user()->nip,
                    'kategori' => $request->kategori,
                    'bukti' => '',
                    'from' => $request->from,
                    'to' => $request->to,
                    'status' => 'waiting'
                ];
                
                //Menyimpan Data Reimbursement dan mendapatkan id row nya
                $id = Reimbursement::create($reimbursementValue)->id;

                //Upload file
                $file = $request->file('bukti');
                $setNamaFile = $id . Auth::user()->nip . "." . $file->getClientOriginalExtension();
                //$path = $file->move(public_path('uploads'), $setNamaFile);
                $path = $file->storeAs('public/bukti', $setNamaFile);

                //menyimpan nama file pada database
                Reimbursement::where('id', $id)->update(['bukti' => $setNamaFile]);

                //Menyimpan data detail reimbursement
                $jumlahRow = count($request->tanggal);
                for($i = 0; $i < $jumlahRow; $i++){

                    $request->validate([
                        'tanggal' => 'required',
                        'deskripsi' => 'required',
                        'pengeluaran' => 'required'
                    ]);

                    $tanggal = $request->tanggal;
                    $deskripsi = $request->deskripsi;
                    $pengeluaran = $request->pengeluaran;

                    $detailValue = [
                        'id_reimbursement' => $id,
                        'tanggal' => $tanggal[$i],
                        'deskripsi' => $deskripsi[$i],
                        'pengeluaran' => $pengeluaran[$i]
                    ];
                    
                    ReimbursementDetail::create($detailValue);

                }
            });

            return redirect('/reimbursement')->with('success','Reimbursement anda telah berhasil diajukan');

        } catch (ValidationException $e) {
            
            return redirect()->back()->withErrors($e->getMessage())->withInput();

        } catch (\Exception $e){

            return redirect()->back()->withErrors("Maaf Terjadi Kesalahan, Claim Gagal Diajukan")->withInput();

        }
    }

    public function verification(Request $request){
        // $reimbursement = Reimbursement::where('id', $request->id)->first();
        // $statusVal = [
        //     'status' => $request->status
        // ];
        // $reimbursement->update($statusVal);
        // return redirect('/reimbursement');
    }

    public function markClaimed(Request $request){
        // $reimbursement = Reimbursement::where('id', $request->id)->first();
        // $statusVal = [
        //     'status' => $request->status
        // ];
        // $reimbursement->update($statusVal);
        // return redirect('/reimbursement');
    }


    public function updateStatus(Request $request){
        $reimbursement = Reimbursement::where('id', $request->id)->first();
        $statusVal = [
            'status' => $request->status
        ];
        $reimbursement->update($statusVal);
        return redirect('/reimbursement');
    }

    public function cancelClaim(Request $request){
        //Get Data
        $reimbursement = Reimbursement::where('id', $request->id)->first();
        
        //Delete File Bukti
        $path = storage_path('app/public/bukti/'.$reimbursement->bukti);

        if(file_exists($path)) {
            unlink($path);
        }
        
        //Delete Row
        $reimbursement->delete();
        
        return redirect('/reimbursement');
    }
}
