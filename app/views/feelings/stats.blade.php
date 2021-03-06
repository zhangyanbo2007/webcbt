{{--

The MIT License (MIT)

WebCBT - Web based Cognitive Behavioral Therapy tool

http://webcbt.github.io

Copyright (c) 2014 Prashant Shah <pshah.webcbt@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

--}}

@extends('layouts.master')

@section('head')

<script type="text/javascript">

$(document).ready(function() {
});

</script>

@stop

@section('page-title', 'Feelings Statistics')

@section('content')

{{ HTML::linkAction('FeelingsController@getIndex', 'Back', array(), array('class' => 'btn btn-primary')) }}

<br />
<br />

<div class="text-center">
        <div class="chart-title">{{ $feeling->name }}</div>
	<canvas id="feelingsChart" height="500px"></canvas>
</div>

<script type="text/javascript">

var feelingsChartData = {
	labels : {{ $labelset }},
	datasets : [
		{
			label: "Before",
			fillColor : "rgba(151,187,205,0.2)",
			strokeColor : "rgba(151,187,205,1)",
			pointColor : "rgba(151,187,205,1)",
			pointStrokeColor : "#fff",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(151,187,205,1)",
			data : {{ $before_dataset }}
		},
		{
			label: "After",
			fillColor : "rgba(0,187,205,0.2)",
			strokeColor : "rgba(0,187,205,1)",
			pointColor : "rgba(0,187,205,1)",
			pointStrokeColor : "#fff",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(151,187,205,1)",
			data : {{ $after_dataset }}
		}
	]

}

window.onload = function() {
	var feelingsCtx = document.getElementById("feelingsChart").getContext("2d");

        @if ($chart_type == 'bar')
        window.feelingsChart = new Chart(feelingsCtx).Bar(feelingsChartData, {
        @else
        window.feelingsChart = new Chart(feelingsCtx).Line(feelingsChartData, {
        @endif

		responsive: false,
                scaleOverride : true,
                scaleSteps : 10,
                scaleStepWidth : 1,
                scaleStartValue : 0,
                barValueSpacing: 5
	});
}

</script>

@stop
