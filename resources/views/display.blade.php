@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<?php $i=1;?>  
<div class="container">
    <div class="row">
        <form id="form_id" method="POST" action="">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>Company:</label>
                        <input type="text" class="form-control" name="company">
                       <!--  <select class="form-control" name="company">
                            <option>Please Select</option>
                            @foreach($company as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select> -->
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>Department:</label>
                        <input type="text" class="form-control" name="department">
                       <!--  <select class="form-control" name="department">
                            <option>Please Select</option>
                            @foreach($department as $key1 => $value1)
                            <option value="{{$key1}}">{{$value1}}</option>
                            @endforeach
                        </select> -->
                        </p>
                    </div>
                </div>
                 <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>Employee Name:</label>
                        <input type="text" class="form-control" name="emp_name">
                    </div>
                </div>
                 <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary create_form" id="create_emp">Create</button>
                    </div>
                </div>
                
            </div>        
            
        </form>
         
    </div>
    
    <div class="row">
        <table id="display_records" class="table">
            <thead>
                <tr>
                   <th>Sr.No</th>
                   <th>Company</th> 
                   <th>department</th> 
                   <th>employment</th> 
                </tr>
            </thead>
            <tbody id="table_body">
                @foreach($get_all_data as $key=>$value_all)
                    @foreach($value_all->department_all as $keys=>$value_all_dept)
                        @foreach($value_all_dept->employment_all as $key_emp=>$value_emp)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$value_all->name}}</td>
                                <td>{{$value_all_dept->name}}</td>
                                <td>{{$value_emp->name}}</td>
                            </tr> 
                            <?php $i++;?>     
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>    
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript">
  
  $(function(){

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
         $("#form_id").submit(function(e){


            e.preventDefault();
            var daynamically = new FormData($(this)[0]);
            console.log($(this));
            $.ajax({
                url:"{{url('/create')}}",
                type:"POST",
                dataType:"JSON",
                data:daynamically,
                contentType: false,
                cache: false,
                processData: false,
                success : function(response){

                    if(response.status==true){
                       
                        $("#form_id")[0].reset();
                        var tr = "";
                        var inc = 1;
                        console.log(response.get_all_data);
                        $.each(response.get_all_data,function(index,val_all){
                            
                            $.each(val_all.department_all,function(index1,val_dep){
                                
                                $.each(val_dep.employment_all,function(index2,val_emp){

                                        tr += '<tr>'+
                                            '<td>'+inc+'</td>'+
                                            '<td>'+val_all.name+'</td>'+
                                            '<td>'+val_dep.name+'</td>'+
                                            '<td>'+val_emp.name+'</td>'+
                                            '</tr>';
                                
                                    inc++;
                                });
                                
                            });

                        });

                        $("#table_body").html(tr);
                        
                    }
               }
            });
        });
  });
       

</script>
