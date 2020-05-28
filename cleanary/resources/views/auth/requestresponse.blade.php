
@if($preturn->status=="success")
<div class='list-group center-block' id='resp'>
<fieldset class='list-group-item active'><legend><h1 class='list-group-item'>Request Response</h1></legend>
<h1 class='list-group-item active'>Transaction Successful</h1>
<P class='list-group-item'>Hi <b>$laundry->user_id </b><br /> The transaction you made on:<br />$preturn->reference was successful, transaction total ammount is > $preturn->amount.<br />Click <a href='http://aubics.com'>here</a> to continue</p>
  </fieldset></div>
  @else
  <div class='list-group center-block' id='resp'>
<fieldset class='list-group-item active'><legend><h1 class='list-group-item'>Request Response</h1></legend>
<h1 class='list-group-item active'>Transaction Not Successful</h1>
<P class='list-group-item'>Hi <b>$laundry->user_id </b><br /> The transaction you made on:<br />$preturn->reference was not successful, transaction total ammount is > $preturn->amount.<br />Click <a href='http://aubics.com'>here</a> to continue</p>
  </fieldset></div>
@endif