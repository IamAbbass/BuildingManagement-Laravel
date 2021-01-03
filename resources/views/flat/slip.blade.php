<!DOCTYPE html>
<html>

@php

function convert_number_to_words($number){
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;

}

@endphp
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
        <h4 class="text-center">Saima Square One Residents Tower Association
            <br />
            <small>Plot No. 1185/G, Stadium Road, Block 10-A, Gulshan-e-Iqbal, Karachi</small>
            <br />
            <small>Bank Name: MUSLIM COMMERCIAL BANK LTD.</small>
            <br />
            <small>Account Title: SAIMA SQUARE ONE TOWERS RESIDENTS ASSOCIATION</small>
            <br />
            <small>Account No: 1071560271010048</small>
            <br />
            <small>IBAN Number: PK25MUCB1071560271010048</small>
        </h4>
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
            <div class="one_two bold"><span>Amount ({{ ucfirst($payment->method) }} {{ $payment->cheque_no }}):</span></div>
            <div class="one_two capitalize">
                <span class="amount">
                    {{ number_format($payment->payment) }} /-
                    <br/>
                    {{ convert_number_to_words($payment->payment)." Only." }}
                </span>
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
		<h4 class="text-center">Saima Square One Residents Tower Association
            <br />
            <small>Plot No. 1185/G, Stadium Road, Block 10-A, Gulshan-e-Iqbal, Karachi</small>
            <br />
            <small>Bank Name: MUSLIM COMMERCIAL BANK LTD.</small>
            <br />
            <small>Account Title: SAIMA SQUARE ONE TOWERS RESIDENTS ASSOCIATION</small>
            <br />
            <small>Account No: 1071560271010048</small>
            <br />
            <small>IBAN Number: PK25MUCB1071560271010048</small>
        </h4>
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
            <div class="one_two bold"><span>Amount ({{ ucfirst($payment->method) }} {{ $payment->cheque_no }}):</span></div>
            <div class="one_two capitalize">
                <span class="amount">
                    {{ number_format($payment->payment) }} /-
                    <br/>
                    {{ convert_number_to_words($payment->payment)." Only." }}

                </span>
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
