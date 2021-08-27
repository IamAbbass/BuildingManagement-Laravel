<?php

namespace App\Http\Controllers;

use \App\Models\Flat;
use \App\Models\Block;
use \App\Models\AccountHead;
use \App\Models\Maintenance;
// use \Maatwebsite\Excel\Excel;
use \App\Imports\ImportExcel;
use \Maatwebsite\Excel\Facades\Excel;
use Carbon\CarbonPeriod;

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
        $account_heads = AccountHead::all();

        return view('flat.index',[
            'flats'     => $flats,
            'blocks'    => $blocks,
            'selected_block' => $selected_block,
            'account_heads' => $account_heads,
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
        $head   = request('head');
        if($head){
            $account_head  = AccountHead::findOrFail($head);        
            $title = "Block-".$block->name." ".date('M-Y')." '$account_head->name Defaulter List'";
        }else{
            $title = "Block-".$block->name." ".date('M-Y')." 'Complete Defaulter List'";
        }

        
        return view('flat.defaulter',[
            'flats'     => $flats,
            'block'     => $block,
            'title'     => $title,
        ]);
    }

    public function show($flat_id)
    {
        $flat = Flat::findOrFail($flat_id);

        
        //whereIn('date',$queryDates)
        $payments = Maintenance::where('is_cancelled',false)
        ->where('flat_id',$flat_id)->get();     

        return view('flat.show',[
            'flat' => $flat,
            'payments' => $payments
        ]);
    }

    public function print($flat_id)
    {
        $flat = Flat::findOrFail($flat_id);

        $from   = strtoupper(date('d-M-Y',strtotime(request('from'))));
        $to     = strtoupper(date('d-M-Y',strtotime(request('to'))));
        
        $dates = CarbonPeriod::create($from,$to);
        $queryDates = array();        

        foreach($dates as $date){
            $queryDates[] = strtoupper(date('d-M-Y',strtotime($date)));
        }

        $payments = Maintenance::whereIn('date',$queryDates)
        ->where('is_cancelled',false)
        ->where('flat_id',$flat_id)->get();     

        return view('flat.ledger',[
            'flat' => $flat,
            'payments' => $payments
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
        ->where('is_cancelled',false) //not cancelled
        ->where('head_id',request('head_id'))->count();

        if($already_paid == 0){
            $month  = strtoupper(date("M-Y", strtotime(request('month'))));
            $date   = strtoupper(date("d-M-Y", strtotime(request('date'))));
            $flat   = Flat::findOrFail($id);

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
                'created_by' => auth()->id()
            ]);            

            $username   = "923022203204";///Your Username
            $password   = "riahuzM@25";///Your Password
            $sender     = "Saima One";
            $mobile     = $flat->person_mobile;
            // $message    = "Thanks ".($flat->person_name).". Rs. ".number_format(request('amount'))." Received.";

            //Account Head
            $account_head = AccountHead::findOrFail(request('head_id'));

            $message    = "Saima Square One: Received with thanks Rs. ".(number_format(request('amount')))."/- Flat # SSQ1-(".($flat->name).")";
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

                $payment->update([
                    'sms_delivery'=> $result,
                ]);
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

        $alread_generated   = Maintenance::where('head_id',1)
        ->where('type','partial')
        ->where('month',$month)
        ->where('payment',0)->count();

        if($alread_generated == 456){ //already generated
            session()->flash('success','Monthly Cycle Already Generated');
            return redirect('/flat');
        }else{
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
                    $payment = Maintenance::create([
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

            session()->flash('success','Monthly Cycle Generated');
            return redirect('/flat');
        }  
        
    }

    public function method($id){
        $result = Maintenance::findOrFail($id);
        if ($result->date == strtoupper(date("d-M-Y"))) {
            $result->update([
                'method' => $result->method == "cash" ? "cheque" : "cash",
                'updated_by' => auth()->id()
            ]);
            session()->flash('success','Payment method updated.');
            return redirect()->back();
        }
        else {
            session()->flash('danger','You are not allowed to update payment method of old generated slips!');
            return redirect()->back();
        }
    }

    public function advance(){
        $flat_array = ["E-0703","E-1005","G-0501","G-0503","G-0705","F-0502","F-1103","C-0404","C-0704","A-0301","C-1001","D-0901", "B-0105", "G-0403", "C-0702", "G-0203", "G-0904", "G-0102", "G-0402", "A-1104", "E-0101", "E-0103", "E-1002", "E-0701", "B-0103", "A-0106", "F-0203", "F-0904", "D-1204", "G-0803", "B-0106", "G-0802", "E-0105", "G-0202", "C-0104", "D-0303", "A-0305", "E-1205", "A-0306", "G-0306", "F-1005","F-0904"];
        $date_array = ["22-Apr-20","4-Aug-20","18-Aug-20","19-Aug-20","21-Aug-20","6-Oct-20","27-Oct-20","4-Nov-20","7-Nov-20","12-Nov-20","25-Nov-20","28-Nov-20","3-Dec-20","4-Dec-20","5-Dec-20","5-Dec-20","6-Dec-20","6-Dec-20","8-Dec-20","9-Dec-20","9-Dec-20","9-Dec-20","10-Dec-20","12-Dec-20","13-Dec-20","14-Dec-20","18-Dec-20","21-Dec-20","21-Dec-20","22-Dec-20","23-Dec-20","23-Dec-20","24-Dec-20","24-Dec-20","24-Dec-20","26-Dec-20","27-Dec-20","27-Dec-20","27-Dec-20","28-Dec-20","30-Dec-20","21-Dec-20"];
        $slip_array = ["5096","6079","6269","6280","6890","6739","6954","7015","7059","7155","7262","7271","7336","7348","7361","7367","7382","7389","7423","7425","7435","7436","7470","7475","7500","7503","7553","7577","7584","7595","7598","7599","7607","7608","7609","7618","7623","7624","7628","7631","7642","7577"];
        $JAN2021 = [true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true];
        $FEB2021 = [true,true,true,true,true,true,true,true,false,false,false,false,true,false,false,false,false,false,true,false,true,true,false,false,false,true,true,true,true,false,false,true,false,false,false,true,true,false,true,false,true,true];
        $MAR2021 = [false,false,false,true,true,false,true,false,false,false,false,false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
        $APR2021 = [false,false,false,true,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
        $MAY2021 = [false,false,false,true,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
        $JUN2021 = [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,true,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
    
        $count = 0;

        foreach($flat_array as $key => $name){   
            $month = "JAN-2021";   
            if($JAN2021[$key]){
                $flat = Flat::where('name',$name)->first();


                $trashed   = Maintenance::where('head_id',1)->where('flat_id',$flat->id)->where('type','partial')
                ->where('month',$month)->where('payment',0)->get();
                foreach($trashed as $trash){
                    $trash->delete();
                }  


                $already_paid   = Maintenance::where('flat_id',$flat->id)
                ->where('month',$month)
                ->where('head_id',1)->first();

                $already_paid->delete();

                $payment = Maintenance::create([
                    'head_id' => 1,
                    'flat_id' => $flat->id,
                    'amount' => 10000,
                    'discount' => 0,
                    'method' => 'cash',
                    'date' => $date_array[$key],
                    'type' => 'full',
                    'month' => $month,
                    'old_slip_no' => $slip_array[$key],
                    'payment' => 10000,
                ]);
                $count++;   

            }
        }   
        
        foreach($flat_array as $key => $name){   
            $month = "FEB-2021";   
            if($FEB2021[$key]){
                $flat = Flat::where('name',$name)->first();

                $trashed   = Maintenance::where('head_id',1)->where('flat_id',$flat->id)->where('type','partial')
                ->where('month',$month)->where('payment',0)->get();
                foreach($trashed as $trash){
                    $trash->delete();
                }

                $already_paid   = Maintenance::where('flat_id',$flat->id)
                ->where('month',$month)
                ->where('head_id',1)->first();

                $already_paid->delete();

                $payment = Maintenance::create([
                    'head_id' => 1,
                    'flat_id' => $flat->id,
                    'amount' => 10000,
                    'discount' => 0,
                    'method' => 'cash',
                    'date' => $date_array[$key],
                    'type' => 'full',
                    'month' => $month,
                    'old_slip_no' => $slip_array[$key],
                    'payment' => 10000,
                ]);
                $count++;  
            }
        }    

        foreach($flat_array as $key => $name){   
            $month = "MAR-2021";   
            if($MAR2021[$key]){
                $flat = Flat::where('name',$name)->first();

                $trashed   = Maintenance::where('head_id',1)->where('flat_id',$flat->id)->where('type','partial')
                ->where('month',$month)->where('payment',0)->get();
                foreach($trashed as $trash){
                    $trash->delete();
                }

                $already_paid   = Maintenance::where('flat_id',$flat->id)
                ->where('month',$month)
                ->where('head_id',1)->first();

                $already_paid->delete();

                $payment = Maintenance::create([
                    'head_id' => 1,
                    'flat_id' => $flat->id,
                    'amount' => 10000,
                    'discount' => 0,
                    'method' => 'cash',
                    'date' => $date_array[$key],
                    'type' => 'full',
                    'month' => $month,
                    'old_slip_no' => $slip_array[$key],
                    'payment' => 10000,
                ]);
                $count++;  
            }
        }    

        foreach($flat_array as $key => $name){   
            $month = "APR-2021";   
            if($APR2021[$key]){
                $flat = Flat::where('name',$name)->first();

                $trashed   = Maintenance::where('head_id',1)->where('flat_id',$flat->id)->where('type','partial')
                ->where('month',$month)->where('payment',0)->get();
                foreach($trashed as $trash){
                    $trash->delete();
                }

                $already_paid   = Maintenance::where('flat_id',$flat->id)
                ->where('month',$month)
                ->where('head_id',1)->first();

                $already_paid->delete();

                $payment = Maintenance::create([
                    'head_id' => 1,
                    'flat_id' => $flat->id,
                    'amount' => 10000,
                    'discount' => 0,
                    'method' => 'cash',
                    'date' => $date_array[$key],
                    'type' => 'full',
                    'month' => $month,
                    'old_slip_no' => $slip_array[$key],
                    'payment' => 10000,
                ]);
                $count++;  
            }
        } 

        foreach($flat_array as $key => $name){   
            $month = "MAY-2021";   
            if($MAY2021[$key]){
                $flat = Flat::where('name',$name)->first();

                $trashed   = Maintenance::where('head_id',1)->where('flat_id',$flat->id)->where('type','partial')
                ->where('month',$month)->where('payment',0)->get();
                foreach($trashed as $trash){
                    $trash->delete();
                }

                $already_paid   = Maintenance::where('flat_id',$flat->id)
                ->where('month',$month)
                ->where('head_id',1)->first();

                $already_paid->delete();

                $payment = Maintenance::create([
                    'head_id' => 1,
                    'flat_id' => $flat->id,
                    'amount' => 10000,
                    'discount' => 0,
                    'method' => 'cash',
                    'date' => $date_array[$key],
                    'type' => 'full',
                    'month' => $month,
                    'old_slip_no' => $slip_array[$key],
                    'payment' => 10000,
                ]);
                $count++;  
            }
        } 

        foreach($flat_array as $key => $name){   
            $month = "JUN-2021";   
            if($JUN2021[$key]){
                $flat = Flat::where('name',$name)->first();

                $trashed   = Maintenance::where('head_id',1)->where('flat_id',$flat->id)->where('type','partial')
                ->where('month',$month)->where('payment',0)->get();
                foreach($trashed as $trash){
                    $trash->delete();
                }

                $already_paid   = Maintenance::where('flat_id',$flat->id)
                ->where('month',$month)
                ->where('head_id',1)->first();

                $already_paid->delete();

                $payment = Maintenance::create([
                    'head_id' => 1,
                    'flat_id' => $flat->id,
                    'amount' => 10000,
                    'discount' => 0,
                    'method' => 'cash',
                    'date' => $date_array[$key],
                    'type' => 'full',
                    'month' => $month,
                    'old_slip_no' => $slip_array[$key],
                    'payment' => 10000,
                ]);
                $count++;  
            }
        } 

        return $count."";
    }

    
}