@extends('layouts.app')
@section('content')

@if (Auth::check())


<a class="backBtn arrow arrow--right" href="{{URL::to('/')}}"></a>

<style>
    .dailyContainer{
        width: 970px;
        background: #eeeeee;
        margin: 0 auto;

    }

    .daybox{
        width: 118px;
        height: 118px;
        border-radius: 10px;
        margin: 10px 10px;
        background-color: rgb(191, 191, 191);
        text-align: center;
        padding: 45px 0;
    }

    .dailyContainer_box{
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .daybox_kcal{
        font-size: 24px;
    }

    .daybox_kcal span{
        font-size: 14px;
    }

    .daybox_date{
        text-align: center;
    }

    .daily__today__box{
        color: #ff3d3d;
    }

    .daybox__today{
        background-color: rgb(175, 106, 106);
    }

    .loginday{
        background-color: #9cd2d2;
    }

    .daybox__nonday{
        background-color: rgb(94, 94, 94);
    }
    
    



</style>

<div>


        <h2 style="text-align: center;font-size: 36px;">日誌</h2>

        <div>

            <div class="dailyContainer" style="margin-top: 100px">
                <div class="dailyContainer_box">
                    @php
                        $year = 2021;
                        $month = date('m');
                        $lastday = date('t',strtotime($year . "/" . $month . "/01"));
                        $i = 0;
                        $ss = (new DateTimeImmutable)->modify('first day of')->format('m-d'); 
                        $date = new DateTime('first day of this month');
                    @endphp

      
                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
                    

                    @for ($c = 0; $c < $lastday; $c++)
                    <div>
                        <a href="{{URL::to('daily/'.$date->modify($i.' day')->format('y-m-d') )}}">
                            @if ($date->format('m-d') === date('m-d'))
                                <div class="daybox daybox__today">
                                    @if (  isset($dayKcal[$date->format('y-m-d')])  )
                                    {{ $dayKcal[$date->format('y-m-d')] }}<span>kcal</span>
                                    @else
                                    0<span>kcal</span>
                                    @endif
                                </div>
                                <p class="daily__today__box" style="text-align: center">{{ $date->format('m-d') }}</p>
                            @else
                            @if (  isset($dayKcal[$date->format('y-m-d')])  )
                                    <div class="daybox loginday">
                                    <span class="loginday">{{ $dayKcal[$date->format('y-m-d')] }}</span><span>kcal</span>
                                    </div>
                                    @else
                                    <div class="daybox">
                                    0<span>kcal</span>
                                    </div>
                                    @endif
                                <p style="text-align: center">{{ $date->format('m-d') }}</p>
                            @endif
                        </a>
                        
                        @php
                        $i = +1;
                        @endphp
                    </div>
                    @endfor

                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
                    <div class="daybox daybox__nonday"></div>
    



                </div>
            </div>
 
        </div>
</div>



@endif

@endsection