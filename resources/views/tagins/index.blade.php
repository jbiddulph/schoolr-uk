@extends('layouts.list')

@section('content')
    <div class="colorbar"></div>
    <div class="container mt-4 welcome">
        <h1>Pubs &amp; Venues</h1>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Charts</b></div>
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
    <script type="text/javascript">

    var url = "{{url('tagin/chart')}}";
    var phone_number = new Array();
    var venue_id = new Array();
    $(document).ready(function(){
        $.get(url, function(response){
            response.forEach(function(data){
                phone_number.push(data.phone_number);
                venue_id.push(data.venue_id);
            });
            var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:phone_number,
                    datasets: [{
                        label: 'Venue ID',
                        data: venue_id,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    });
</script>
@endsection
