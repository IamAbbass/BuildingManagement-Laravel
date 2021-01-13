<?php

namespace App\Http\Controllers;

use \App\Models\Flat;
use \App\Models\Block;
use \App\Models\AccountHead;
use \App\Models\Maintenance;
// use \Maatwebsite\Excel\Excel;
use \App\Imports\ImportExcel;
use \Maatwebsite\Excel\Facades\Excel;

class FlatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $blocks = Block::all();
        $selected_block = request('block') ?? 1;
        $flats  = Flat::where('block_id',$selected_block)->get();

        return view('flat.index',[
            'flats'     => $flats,
            'blocks'    => $blocks,
            'selected_block' => $selected_block,
        ]);
    }

    public function export($selected_block)
    {        
        $flats  = Flat::where('block_id',$selected_block)->get();
        $block  = Block::findOrFail($selected_block);


        return view('flat.export',[
            'flats'     => $flats,
            'block' => $block,
        ]);
    }

    //yahan
    public function defaulter($selected_block)
    {        
        $flats  = Flat::where('block_id',$selected_block)->get();
        $block  = Block::findOrFail($selected_block);


        return view('flat.defaulter',[
            'flats'     => $flats,
            'block'     => $block,
        ]);
    }

    public function show($id)
    {
        $flat = Flat::findOrFail($id);
        return view('flat.show',[
            'flat' => $flat,
        ]);
    }

    public function print($id)
    {
        $flat = Flat::findOrFail($id);
        return view('flat.ledger',[
            'flat' => $flat,
        ]);
    }
    
    public function edit($id)
    {
        $flat = Flat::findOrFail($id);
        return view('flat.edit',[
            'flat' => $flat,
        ]);
    }
    
    public function update($id)
    {
        $flat = Flat::findOrFail($id);
        $flat->update([
            'person_name'=> request('person_name'),
            'person_email'=> request('person_email'),            
            'person_mobile'=> request('person_mobile'),
            'person_mobile2'=> request('person_mobile2'),
            'ptcl_no' => request('ptcl_no'),
            'person_cnic'=> request('person_cnic'),
            'person_perm_address'=> request('person_perm_address'),
            'tenant_name'=> request('tenant_name'),  
            'notes'=> request('notes'),
            'status'=> request('status'),
            'updated_by'=> auth()->id(),
        ]);
        session()->flash('success','Flat Info Updated!');
        return redirect('/flat'); 
    }

    public function payment($id)
    {
        $flat           = Flat::findOrFail($id);
        $account_heads  = AccountHead::where('default_amount','>',0)->get();

        return view('flat.payment',[
            'account_heads' => $account_heads,
            'flat' => $flat,
        ]);
    }

    public function payment_save ($id)
    { 
        $month          = strtoupper(date("M-Y", strtotime(request('month'))));

        /*
        except this MONTH
        */

        //Balance Delete
        $trashed   = Maintenance::where('head_id',1)->where('flat_id',$id)->where('type','partial')
        ->where('month',$month)->where('payment',0)->get();
        foreach($trashed as $trash){
            $trash->delete();
        }        
        
        $already_paid   = Maintenance::where('flat_id',$id)
        ->where('month',$month)
        ->where('type','full')
        ->where('head_id',request('head_id'))->count();

        if($already_paid == 0){
            $month  = strtoupper(date("M-Y", strtotime(request('month'))));
            $date   = strtoupper(date("d-M-Y", strtotime(request('date'))));

            $payment = Maintenance::create([
                'head_id' => request('head_id'),
                'flat_id' => $id,
                'amount' => request('amount'),
                'discount' => request('discount'),
                'method' => request('method'),
                'cheque_no' => request('cheque_no'),
                'date' => $date,
                'type' => request('type'),
                'month' => $month,
                'payment' => request('payment'),
                'description' => request('description'),
                'old_slip_no' => request('old_slip_no'),     
            ]);

            $flat = Flat::findOrFail($id);

            $username   = "923022203204";///Your Username
            $password   = "riahuzM@25";///Your Password
            $sender     = "Saima One";
            $mobile     = $flat->person_mobile;
            // $message    = "Thanks ".($flat->person_name).". Rs. ".number_format(request('amount'))." Received.";

            //Account Head
            $account_head = AccountHead::findOrFail(request('head_id'));

            $message    = "Received with thanks Rs. ".(number_format(request('amount')))."/- Flat # (".($flat->name).")";
            $message    .= " against ".$account_head->name.".";
            $message    .= " Payment by ".ucfirst(request('method'));            
            $message    .= " for the month of $month.";
            // $message    .= " Balance 20,000/- ";
            $message    .= " $date ".date("h:i A");

            if($flat->person_mobile){
                $post = "sender=".urlencode($sender)."&mobile=".urlencode($mobile)."&message=".urlencode($message)."";
                $url = "https://sendpk.com/api/sms.php?username=$username&password=$password";
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $result = curl_exec($ch); 
            }
            

            return redirect("/slip/$payment->id"); 
        }else{
            session()->flash('danger','Maintenance For '.$month.' Already Paid!');
            return back(); 
        }
        
        
    } 
    
    public function slip ($id)
    {     
        $payment = Maintenance::findOrFail($id);

        return view("flat.slip",[
            'payment' => $payment,
        ]); 
    }
    
    public function import ()
    {     
        $import = Excel::toCollection(new ImportExcel, "excel.xlsx");
        $sheet_one = $import[0];

        $flat_id = null;
        // $flat = 0;


        foreach($sheet_one as $key => $row){
            // 0 = due date
            // 1 = description
            // 2 = dues
            // 3 = discount
            // 4 = net Rcvble
            // 5 = received
            // 6 = balance
            // 7 = slip no

            if (strpos($row[0], 'UNIT') !== false) { //Load the flat     
                // echo $row[1]."<br/>";           
                $flat_id = Flat::where('name',$row[1])->first()->id;
                // $flat++;
            }

            if (strpos($row[0], '2017') !== false || strpos($row[0], '2018') !== false || strpos($row[0], '2019') !== false || strpos($row[0], '2020') !== false) {
                if($row[1] == "Maintenance"){
                    $head_id = 1;
                }else if($row[1] == "Membership"){
                    $head_id = 2;
                }else if($row[1] == "RO Plant"){
                    $head_id = 3;
                }else{
                    $head_id = 0;
                }
                
                Maintenance::create([
                    'head_id' => $head_id,
                    'flat_id' => $flat_id,
                    'amount' => $row[2],
                    'discount' => $row[3],
                    'method' => 'cash',
                    'date' => "01-".$row[0],
                    'type' => ($row[6] == "0") ? 'full' : 'partial',
                    'month' => $row[0],
                    'payment' => $row[5],
                    'description' => $row[1],
                    'old_slip_no' => $row[7]
                ]);
            }
        }
        return ['success' => true];
    }   
    public function cycle (){
        $flats = Flat::all();
        $month = strtoupper(date("M-Y"));


        //remove trash
        foreach($flats as $flat){
            $trashed   = Maintenance::where('head_id',1)
            ->where('flat_id',$flat->id)
            ->where('type','partial')
            ->where('month',$month)
            ->where('payment',0)->get();
            foreach($trashed as $trash){
                $trash->delete();
            }
        }  
    
        $count = 0;
        foreach($flats as $flat){
            $already_paid   = Maintenance::where('flat_id',$flat->id)
            ->where('month',$month)
            // ->where('type','full')
            ->where('head_id',1)->count();

            if($already_paid == 0){
                Maintenance::create([
                    'head_id' => 1,
                    'flat_id' => $flat->id,
                    'amount' => 10000,
                    'discount' => 0,
                    'method' => 'cash',
                    'date' => "",
                    'type' => 'partial',
                    'month' => $month,
                    'payment' => 0,
                ]);
                $count++;
            }
        }

             


        return [
            'success' => true,
            'count' => $count,
        ];


        
    }

    
}