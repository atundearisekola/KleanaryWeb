<div className="row">
<div className="col-md-12">
<span>Upload File</span>
 <input type="file"  id="laundryimg"  name="laundryimg[]" multiple="multiple" />
</div>
<div className="col-md-12">

<div className={classes.req} >

<TextField
select
className={clsx(classes.margin, classes.textField)}
variant="outlined"
label="With Select"
value={this.state.weightRange}
onChange={handleChange('weightRange')}
InputProps={{
startAdornment: <InputAdornment position="start">Kg</InputAdornment>,
}}
>
{ranges.map(option => (
<MenuItem key={option.value} value={option.value}>
{option.label}
</MenuItem>
))}
</TextField>
<InputLabel shrink>Count</InputLabel>

<button><AddCommentIcon/></button>
</div>
<table class="table table-striped table-bordered table-hover"  id="kv">
               
           </table>
</div>
</div>

headers:{
    'Content-Type': 'application/json;charset=UTF-8',
    'Access-Control-Allow-Origin' : '*',
    'Access-Control-Allow-Methods': 'GET,HEAD,PUT,PATCH,POST,DELETE,OPTIONS',
    "preflightContinue": 'false',
    'Accept': 'application/json',

}