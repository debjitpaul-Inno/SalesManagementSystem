<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .barcode-cell {
            width: 100%;
            padding: 0px;
            float: right;
            vertical-align: middle;
            transform: rotate(90deg)
        }
        .font{
            font-family: Lucida Sans Typewriter,Lucida Console,monaco,Bitstream Vera Sans Mono,monospace;
        }
        .number{
            text-align: center;
            margin: auto;
        }

    </style>
</head>
<body>
<div class="invoice-box">

{{--    @dd($referenceNumber)--}}
    @foreach($barcode_number as $item)
        <div  class="barcode-cell">
            <barcode code='{{$item}}' type='C128A' height="1" class='barcode'}}/>
        </div>
    <div style="width: 100%">
        <div class="number" style="margin: auto">{{$item}}</div>
    </div>
    @endforeach
</div>
</body>



