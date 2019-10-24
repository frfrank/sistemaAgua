<!-- Search form -->
<form  method="GET" action="{{route('servicio')}}">
<div class="row">
<div class="form-group col-md-10 col-sm-8 col-xs-6">
<div class="active-pink-3 active-pink-4">
  <input class="form-control" type="text" name="searchText" placeholder="Search" aria-label="Search" value="{{$searchText}}">
</div>
</div>

<div class="form-group col-md-2 col-sm-2 col-xs-6">
<button type="submit" class="btn btn-primary"> Buscar</button>
</div>
</div>
</form>

<style>
.active-pink-4 input[type=text]:focus:not([readonly]) {
border: 1px solid #2FA360;
box-shadow: 0 0 0 1px #2FA360;
}
.active-pink-3 input[type=text] {
border: 1px solid #2FA360;
box-shadow: 0 0 0 1px #2FA360;
}
.active-purple-4 input[type=text]:focus:not([readonly]) {
border: 1px solid #ce93d8;
box-shadow: 0 0 0 1px #ce93d8;
}
.active-purple-3 input[type=text] {
border: 1px solid #ce93d8;
box-shadow: 0 0 0 1px #ce93d8;
}
.active-cyan-4 input[type=text]:focus:not([readonly]) {
border: 1px solid #4dd0e1;
box-shadow: 0 0 0 1px #4dd0e1;
}
.active-cyan-3 input[type=text] {
border: 1px solid #4dd0e1;
box-shadow: 0 0 0 1px #4dd0e1;
}
</style>