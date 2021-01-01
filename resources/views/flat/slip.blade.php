<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <style type="text/css">
        body{
           font-family: sans-serif;
        }
        kbd{
            background: #333;
            color: #fff;
            padding: 5px;
            border-radius: 7px;
        }
        .container{
            background-image: url("{{ asset('img/logo.png') }}");
            background-color:#fff;
            background-position: -35px -20px;
            background-repeat: no-repeat;
            background-size: 200px;
            border:1px solid #000;
            margin:40px 0;
        }
        .row{
           display: block;
           padding:0 0;
           border-top:1px solid #999;
        }       
        .one_six{
            width:16.66%;
            float:left;
        }
        .one_two{
            width:50%;
            float:left;
        }
        .clearfix{
            clear:both;   
        }
        .row div span{
            padding:10px;
            display: block;
            
        }
        .capitalize{
            text-transform: capitalize;
        }
        .text-center{
            text-align:center;
        }
        .text-right{
            text-align:right;
        }
        .bold{
            font-weight: bold;
        }
        p{
            margin: 0;
        }
        .amount{
        }
        .seperator {
            border-top: 3px dashed;
            margin: 0 5px;
        }

	 </style>
</head>
<body>
    {{-- {{ $payment }} --}}
    
	<!-- Office Copy -->
    <div class="container" >
        <h4 class="text-center"><kbd>Office Copy</kbd></h4>
		<h4 class="text-center">Saima Square One Residents Tower Association<br /><small>Plot No. 1185/G, Stadium Road, Block 10-A, Gulshan-e-Iqbal, Karachi</small></h4>
        <h4 class="text-center"><kbd>Block-{{ $payment->flat->block->name }} / Flat# {{ $payment->flat->name }}</kbd></h4>
        
        <div class="row">
            <div class="one_six bold"><span>Receipt No:</span></div>
            <div class="one_six"><span>{{ $payment->id }}</span></div>
            
            <div class="one_six text-right bold"><span>&nbsp;</span></div>
            <div class="one_six"><span>&nbsp;</span></div>
            
            <div class="one_six text-right bold"><span>Date:</span></div>
            <div class="one_six"><span>{{ $payment->date }}</span></div>            
            <div class="clearfix"></div>
        </div>    
        
        <div class="row">
            <div class="one_two bold"><span>Received with thanks from Mr/Mrs.:</span></div>
            <div class="one_two"><span>{{ $payment->flat->person_name }} </span></div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">            
            <div class="one_two bold"><span>{{ $payment->account->name }} :</span></div>
            <div class="one_two"><span>{{ $payment->month }}</span></div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">            
            <div class="one_two bold"><span>Amount:</span></div>
            <div class="one_two capitalize">
                <span class="amount">{{ number_format($payment->payment) }} /-</span>                
            </div>
            <div class="clearfix"></div>
        </div>
       
        <div class="row" style="padding:5px">
            <p style="font-size: 11px">
               <u style="text-align: left">This is an electronic generated receipt, no signature is required.</u>
               <span style="float: right;">
               <label>Printed By: </label>
               {{ auth()->user()->name }}
                at {{ date('d-M-Y h:i a') }}</span>
            </p> 
        </div>
	</div>

    <!-- Seperator -->
    <div class="seperator"></div>

	<!-- Resident Copy -->
    <div class="container" >
        <h4 class="text-center"><kbd>Resident Copy</kbd></h4>
		<h4 class="text-center">Saima Square One Residents Tower Association<br /><small>Plot No. 1185/G, Stadium Road, Block 10-A, Gulshan-e-Iqbal, Karachi</small></h4>
        <h4 class="text-center"><kbd>Block-{{ $payment->flat->block->name }} / Flat# {{ $payment->flat->name }}</kbd></h4>
        
        <div class="row">
            <div class="one_six bold"><span>Receipt No:</span></div>
            <div class="one_six"><span>{{ $payment->id }}</span></div>
            
            <div class="one_six text-right bold"><span>&nbsp;</span></div>
            <div class="one_six"><span>&nbsp;</span></div>
            
            <div class="one_six text-right bold"><span>Date:</span></div>
            <div class="one_six"><span>{{ $payment->date }}</span></div>            
            <div class="clearfix"></div>
        </div>    
        
        <div class="row">
            <div class="one_two bold"><span>Received with thanks from Mr/Mrs.:</span></div>
            <div class="one_two"><span>{{ $payment->flat->person_name }} </span></div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">            
            <div class="one_two bold"><span>{{ $payment->account->name }} :</span></div>
            <div class="one_two"><span>{{ $payment->month }}</span></div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">            
            <div class="one_two bold"><span>Amount:</span></div>
            <div class="one_two capitalize">
                <span class="amount">{{ number_format($payment->payment) }} /-</span>                
            </div>
            <div class="clearfix"></div>
        </div>
       
        <div class="row" style="padding:5px">
            <p style="font-size: 11px">
               <u style="text-align: left">This is an electronic generated receipt, no signature is required.</u>
               <span style="float: right;">
               <label>Printed By: </label>
               {{ auth()->user()->name }}
                at {{ date('d-M-Y h:i a') }}</span>
            </p> 
        </div>
	</div>
    
    <script type="text/javascript">
		window.print();
	</script>
</body>
</html>