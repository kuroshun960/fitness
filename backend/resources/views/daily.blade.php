@extends('layouts.app')
@section('content')

@if (Auth::check())

<a class="backBtn arrow arrow--right" href="{{URL::to('/')}}"></a>

<div>
    <h2 style="text-align: center;font-size: 36px;">{{date('n')}}月の日誌</h2>
    <div>
        <div class="dailyContainer">
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

                                                            
                                                                        {{--今日の日付のボックス--}}
                                                                        @if ($date->format('m-d') === date('m-d'))


                                                                                
                                                                                <div class="daybox daybox__today">
                                                                                
                                                                                    {{--その日のデータがある時、カロリー表示--}}
                                                                                    @if (  isset($dayKcal[$date->format('y-m-d')])  )
                                                                                        <p>{{ $dayKcal[$date->format('y-m-d')] }}<span class="daybox__kcal">kcal</span></p>
                                                                                    {{--その日のデータがない時、0kcal--}}
                                                                                    @else
                                                                                        <p>0<span class="daybox__kcal">kcal</span></p>
                                                                                    @endif
                                                                                </div>
                                                                            <p class="daybox__date" class="daily__today__box" style="text-align: center">{{ $date->format('j') }}</p>



                                                                        {{--今日以外の日付のボックス--}}
                                                                        @else

                                                                                    {{--その日のデータがある時、カロリー表示--}}
                                                                                    @if (  isset($dayKcal[$date->format('y-m-d')])  )
                                                                                        <div class="daybox loginday">
                                                                                            <span class="loginday">{{ $dayKcal[$date->format('y-m-d')] }}</span><span class="daybox__kcal">kcal</span>
                                                                                        </div>

                                                                                    {{--その日のデータがない時、0kcal--}}
                                                                                    @else
                                                                                        <div class="daybox">
                                                                                            <p>0<span class="daybox__kcal">kcal</span></p>
                                                                                        </div>
                                                                                    @endif
                                                                            <p class="daybox__date" style="text-align: center">{{ $date->format('j') }}</p>
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