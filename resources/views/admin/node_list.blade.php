@extends('admin.layout.base')

@section('title', 'Node List')

@section('styles')
<link rel="stylesheet" href="{{asset('main/vendor/jvectormap/jquery-jvectormap-2.0.3.css')}}">
@endsection
<style>
	#design {
  width: 190px;
  height: 254px;
  background: #07182E;
  position: relative;
  display: flex;
  color:white;
  place-content: center;
  place-items: center;
  overflow: hidden;
  border-radius: 20px;
}
.card{
	box-shadow: 2px 2px 12px 9px grey;

}
#design h2 {
  z-index: 1;
  color: white;
  font-size: 2em;
}

#design::before {
  content: '';
  position: absolute;
  width: 100px;
  background-image: linear-gradient(180deg, rgb(0, 183, 255), rgb(255, 48, 255));
  height: 130%;
  animation: rotBGimg 3s linear infinite;
  transition: all 0.2s linear;
}

@keyframes rotBGimg {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}

#design::after {
  content: '';
  position: absolute;
  background: #07182E;
  ;
  inset: 5px;
  border-radius: 15px;
}  

.status-active {
    background-color: #d4edda; /* Light green background */
    color: #155724; /* Dark green text color */
    padding: 5px 10px; /* Add some padding for the buffer */
    border: 1px solid #c3e6cb; /* Light green border */
    border-radius: 4px; /* Rounded corners */
    display: inline-block; /* Ensures proper display */
    margin-left:25%;
    margin-top:5%;
}
</style>
@section('content')
<div class="content-area py-1">
	<div class="container-fluid">	
        <h4 style="margin-bottom: 2em;">Node Running Details</h4>
		<div class="row row-md">
			<div class="col-lg-4 col-md-6 col-xs-12">
				<div class="box box-block bg-white tile tile-1 mb-2" id="design">
					<div class="t-icon right"></div>
					<div class="t-content">
						<h1 style="padding-left:13%" class="mb-1">Ethereum (ETH)</h1>
                        <p class="status-active">Active</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-xs-12">
				
				<div class="box box-block bg-white tile tile-1 mb-2" id="design">
					<div class="t-icon right"></div>
					<div class="t-content">
						<h1 class="mb-1 text-center">Polygon (POL)</h1>
						<p class="status-active">Active</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-xs-12">
				<div class="box box-block bg-white tile tile-1 mb-2" id="design">
					<div class="t-icon right"></div>
					<div class="t-content">
						<h1 style="padding-left:13%" class="mb-1">Binance (BNB)</h1>
						<p class="status-active">Active</p>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection