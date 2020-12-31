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
        .harmain_bg{
            background-image: url("{{ asset('img/logo.png') }}");
            background-color:#fff;
            background-position: left top;
            background-repeat: no-repeat;
            background-size: 200px;
            border:1px solid #000;
            margin:10px;
        }
        .row{
           display: block;
            padding:5px 0;
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

	 </style>
</head>
<body>
    {{-- {{ $payment }} --}}
    
	<div class="harmain_bg" >
		<h1 class="text-center">Saima Square One Residents Tower Association<br /><small>Plot No. 1185/G, Stadium Road, Block 10-A, Gulshan-e-Iqbal, Karachi</small></h1>
        <p></p>
        
        <h2 class="text-center"><kbd>{{ $expense->head->name }}</kbd></h2>

        <div class="row">
            <div class="one_six bold"><span>Receipt No:</span></div>
            <div class="one_six"><span> E-{{ $expense->id }}</span></div>
            
            <div class="one_six text-right bold"><span>&nbsp;</span></div>
            <div class="one_six"><span>&nbsp;</span></div>
            
            <div class="one_six text-right bold"><span>Date:</span></div>
            <div class="one_six"><span>{{ $expense->date }}</span></div>            
            <div class="clearfix"></div>
        </div>    
        
        <div class="row">
            <div class="one_two"><span>{{ $expense->name }}</span></div>
            <div class="one_two"><span> </span></div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">            
            <div class="one_two"><span>{{$expense->description}}</span></div>
            <div class="one_two"><span> </span></div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">            
            <div class="one_two bold"><span>Amount:</span></div>
            <div class="one_two capitalize">
                <span class="amount"><strong> {{ number_format($expense->amount) }} /-</strong></span>                
            </div>
            <div class="clearfix"></div>
        </div>
       
        <div class="row" style="padding:5px">
            <p>
               <u style="text-align: left">This is an electronic generated receipt, no signature is required</u>
               <span style="float: right;">
               <label>Printed By: </label>
               <u >{{ auth()->user()->name }}</u>
                at {{ date('d-M-Y h:i a') }}</span>
            </p> 


        </div>
	
	</div>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>