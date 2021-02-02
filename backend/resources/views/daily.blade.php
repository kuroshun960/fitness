@extends('layouts.app')
@section('content')

@if (Auth::check())

<a href="{{URL::to('/')}}">もどる</a>

<style>
    .dailyContainer{
        width: 970px;
        background: #eeeeee;
        margin: 0 auto;
        display: flex;
        justify-content: flex-start;
        flex-flow: row-reverse;
    }

    .daybox{
        width: 118px;
        height: 118px;
        border-radius: 10px;
        background-color: rgb(191, 191, 191);
    }

</style>

<div>

    @php
        $i = 0;
    @endphp

        <h2 style="text-align: center;font-size: 36px;">日誌</h2>

        <div>
            <div class="dailyContainer">
                @foreach ( $dayKcal as $day )

                    @php
                        $yest = date('m-d', strtotime($i . ' day'));
                        $yestParameter = date('y-m-d', strtotime($i . ' day'));
                    @endphp

                    <a href="{{URL::to('daily/'.$yestParameter)}}"><div class="daybox">{{ $day }}<br>{{ $yest }}</div></a>

                    @php
                        $i -= 1;
                    @endphp

                @endforeach
            </div>
        </div>


</div>

@endif

@endsection