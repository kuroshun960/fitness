@extends('layouts.app')
@section('content')

@if (Auth::check())

<a href="{{URL::to('/')}}">もどる</a>


<style>

    .item{
        margin-bottom: 10px;
    }

</style>


<div>




    <h2 style="text-align: center;font-size: 36px;">{{ $day }}の食事</h2>

    <div>
        <div class="">

            @foreach ( $eatmeals as $eatmeal )

                    <div class="item" style='display: flex;'>
                    <p>{{ $eatmeal->name }}/</p>
                    <p>{{ $eatmeal->eatKcal }}kcal/</p>
                    <p>{{ $eatmeal->eatProtain }}p/</p>
                    <p>{{ $eatmeal->eatFat }}f/</p>
                    <p>{{ $eatmeal->eatCarbo }}c/</p>
                    <p>{{ $eatmeal->eatPrice }}円/</p>
                    <p>{{ $eatmeal->eatNet }}n</p>
                    </div>


                    {!! Form::open(['route' => ['eats.destroy']]) !!}
                        {!! Form::submit('食べてない！', [ 'name' => $eatmeal->id,'value' => $eatmeal->id,'class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}

            @endforeach

            @foreach ( $protaintasks as $protaintask )

            <div class="item" style='display: flex;'>
            <p>プロテイン/</p>
            <p>{{ $protaintask->kcal }}kcal/</p>
            <p>{{ $protaintask->protain }}p/</p>
            <p>{{ $protaintask->fat }}f/</p>

            </div>

            @endforeach

        </div>

    </div>

    <div>
        <p>総カロリー / {{ $nutdata['allKcal'] }}</p>
        <p>総タンパク質 / {{ $nutdata['allProtain'] }}</p>
        <p>総脂質 / {{ $nutdata['allFat'] }}</p>
        <p>総炭水化物 / {{ $nutdata['allCarbo'] }}</p>
        <p>総費用 / {{ $nutdata['allPrice'] }}</p>
    </div>





</div>



@endif

@endsection