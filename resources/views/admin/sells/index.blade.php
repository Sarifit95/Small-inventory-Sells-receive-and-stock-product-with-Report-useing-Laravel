@extends('layouts.admin')
@section('content')


@if($action=='index')
    <div class="card-header">

        <div class="row">
            <div class="col-sm-2"> <a href="{{route('sells.create')}}" class="btn btn-success">Add New Sells</a>
            </div>
            <div class="col-sm-8"> @if(session()->has('message'))
                    <p class="text-center mb-0 font-weight-bold  alert-{{session('type')}}">
                        {{session('message')}}
                    </p>
                @endif
            </div>

        </div>
        <h3>Sells List</h3>



    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                <tr>
                    <th width="10">
                        SL.No
                    </th>


                    <th>
                        Date
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        invoice number
                    </th>
                    <th>
                       Total Price
                    </th>





                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>

                <?php $num= 1; ?>
                @foreach($sells as $sell)
                    <tr data-entry-id="{{ $sell->id }}">
                        <td>
                            {{ $num }}

                        </td>


                        <td>{{ $sell->date }}</td>
                        <td>{{ $sell->customers->name }}</td>
                        <td>{{ $sell->invoice_no }}</td>
                        <td>{{ $sell->total_price }}</td>





                        <td>


                            <a href="{{ route('sells.show', $sell->invoice_no) }}" class="btn btn-xs btn-info">Details sells</a>






                            {{--                                            <form action="{{ route('products.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">--}}
                            {{--                                                <input type="hidden" name="_method" value="DELETE">--}}
                            {{--                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                            {{--                                                <input type="submit" class="btn btn-xs btn-danger" name='delete' value="Delete">--}}
                            {{--                                            </form>--}}


                        </td>

                    </tr>
                    <?php $num++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>




@elseif($action=='create')





    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- End Breadcrumb-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="chalan" action="{{ route('sells.store') }}"  method="post">
                                @csrf
                                <h4 class="form-header text-uppercase">
                                    <i class="fa fa-address-book-o"></i>
                                  Sells Create
                                </h4>
                                <div class="form-group row">
                                    <label for="invoice_no" class="col-sm-2 col-form-label">invoice number</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="invoice_no" name="invoice_no" readonly value="{{$invoice}}" class="form-control">

                                    </div>

                                    <label for="customer" class="col-sm-2 col-form-label">Customer </label>
                                    <div class="col-sm-4">
                                        <select class="form-control" required id="customer" name="customer" >
                                            <option disabled="disabled" selected="selected" value="" >Select Customer </option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>


                                </div>
                                <div class="form-group row">
                                    <label for="date" class="col-sm-2 col-form-label">Date</label>

                                    <div class="col-sm-4">
                                        <input type="date" id="date" name="date"  class="form-control" required>

                                    </div>

                                </div>


                                <div class="form-group row">
                                <div class="col-sm-12">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th scope="col">Product Price</th>
                                            <th scope="col">Stock </th>
                                            <th scope="col">quantity </th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col"><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                                        </tr>
                                        </thead>
                                        <tbody id="mainbody">

                                        <tr>
                                            <td class="">

                                                <select class="name form-control " id="name0" name="addmore[0][name]"  required>
                                                    <option selected disabled value="">Select Product</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>

{{--                                                <input class="col-sm col-form-label" type="text" name="addmore[0][name]" required id="name0">--}}
                                            </td>
                                            <td>
                                                <input readonly class="stock col-sm col-form-label" type="number" step="any" name="addmore[0][stock]" id="stock0" required>
                                            </td>
                                            <td>
                                                <input class="qty col-sm col-form-label" type="number" step="any" name="addmore[0][qty]" id="qty0"  required>
                                            </td>
                                            <td>
                                                <input class="price col-sm col-form-label" type="number" step="any" name="addmore[0][price]" id="price0" required>
                                            </td>
                                            <td>
                                                <input class="total_price col-sm col-form-label" type="number" step="any" name="addmore[0][total_price]" id="total_price0" required>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>

                                <div class="form-footer">
                                    <a href="{{route('sells.index')}}" class="btn btn-info"><i class="fa fa-times"></i> Reset</a>

                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div></div>
    </div>



@elseif($action=='details')
    <div class="card-header">

        <div class="row">
            <div class="col-sm-2"> <a href="{{route('voucher', $sells->invoice_no)}}" class="btn btn-success">Invoice</a>
            </div>
            <div class="col-sm-8"> @if(session()->has('message'))
                    <p class="text-center mb-0 font-weight-bold  alert-{{session('type')}}">
                        {{session('message')}}
                    </p>
                @endif
            </div>

        </div>
        <h3>Sells Details</h3>

        <p><strong>invoice number: {{ $sells->invoice_no }}</strong></p>
        <p><strong>Customer Name: {{ $sells->customers->name }}</strong></p>
        <p><strong>phone number: {{ $sells->customers->phone_number }}</strong></p>



    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                <tr>
                    <th width="10">
                        SL.No
                    </th>


                    <th>
                      Product
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                      Price
                    </th>

                    <th>
                        Total Price
                    </th>





                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>

                <?php $num= 1; ?>
                @foreach($sells->sellsdetails as $sell)
                    <tr data-entry-id="{{ $sell->id }}">
                        <td>
                            {{ $num }}

                        </td>


                        <td>{{ $sell->product->name }}</td>
                        <td>{{ $sell->qty }}</td>
                        <td>{{ $sell->price }}</td>
                        <td>{{ $sell->total_price }}</td>





                        <td>


{{--                            <a href="{{ route('sells.show', $sell->invoice_no) }}" class="btn btn-xs btn-info">Details sells</a>--}}






                            {{--                                            <form action="{{ route('products.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">--}}
                            {{--                                                <input type="hidden" name="_method" value="DELETE">--}}
                            {{--                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                            {{--                                                <input type="submit" class="btn btn-xs btn-danger" name='delete' value="Delete">--}}
                            {{--                                            </form>--}}


                        </td>

                    </tr>
                    <?php $num++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@elseif($action=='voucher')
    <style type="text/css">
        td, td, th{
            font:bold 11px "Trebuchet MS" ,Tahoma ; color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none

        }
        th{
            border: 1px solid;

        }
        .br-r{
            border-right: 1px solid;
        }
        .heig{
            height: 30px;
        !important;
        }
        @media print {
            /*.print, .main-footer{*/
            /*    display:none;*/
            /*}   */
            .print{
                display:none;
            }
            /*@page { margin: 0 0 10 0; }*/
            /*body { margin: 1.6cm; }*/


        }

        <!--

    </style>
    <div style="background-color: white;  padding-bottom: 100px " class=" w-100;">
        <p class="btn btn-info print" style="margin-left: 40%; width: 100px;" onclick="print()">Print</p>
        <h3 style="padding-top: 10%; padding-left: 30%; text-align: center; "><u>Bill_________________</u></h3>

        <div style="margin-top:30px; padding-left: 10px">
            <table style=" width: 50%;  float: left">
                <tr style=" text-align: center">
                    <td >Name   :</td>
                    <td>{{$sells->customers->name}}</td>
                </tr>
                <tr style="text-align: center">
                    <td >Address:</td>
                    <td>{{$sells->customers->address}}</td>
                </tr>

            </table>
            <table style=" width: 49%">
                <tr style="text-align: center">
                    <td style="">VP NO  :</td>
                    <td>{{ $sells->invoice_no }}</td>
                </tr>
                <tr style="text-align: center">
                    <td style="">Date    :</td>
                    <td>{{ $sells->date }}</td>
                </tr>
            </table>

        </div>
        <div style="margin-top: 60px; padding: 0 10px; ">
            <table class="" style="border: 1px solid; width: 100%; height: 50%; ">

                <tr style="text-align: center" class="heig">
                    <th>SL#</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th> Price</th>

                    <th> Total Price In TK</th>
                </tr>


                <?php $sl=1; $sum=0;?>
                @foreach($sells->sellsdetails as $sell)
                    <tr style="text-align: center;" class="heig">
                        <td class="br-r">{{$sl}}</td>
                        <td class="br-r">{{ $sell->product->name}}</td>

                        <td class="br-r">{{ $sell->qty}}</td>
                        <td class="br-r">{{ $sell->price}}</td>
                        <td class="br-r">{{ $sell->total_price}}</td>

                    </tr>

             <?php  $sl++; ?>

                @endforeach
                <tr >
                    <td class="br-r"></td>
                    <td class="br-r"></td>
                    <td class="br-r"></td>
                    <td class="br-r"></td>

                    <td class="br-r"></td>

                </tr>

                <tr style="border: 1px solid" class="heig">
                    <td colspan="4" class="br-r heig">Total</td>
                    <td style="text-align: center">{{number_format($sells->total_price,2)?? 0}}Tk</td>
                </tr>


            </table>


        </div>

        <div style="position: absolute; bottom: 50px; left: 25%;">
            <h6 style="opacity: 0.9">Customer's Signature
                with seal</h6>

        </div>
        <div style="position: absolute; bottom: 50px; right: 50px;">
            <h3 style="opacity: 0.5">Easca Soft Limited</h3>

        </div>





    </div>

@endif



@section('scripts')
    @parent
    <script>
        $(function () {
            @if($action=='create')
            $(document).ready(function () {
                $('.name').select2();


                // $('#select2-dropdown').select2();
                // $('#select2-dropdown').on('change', function (e) {
                //     var data = $('#select2-dropdown').select2("val");
                //
                // });
            });

            // alert(parseInt(16.25).toFixed(2) > parseInt(15).toFixed(2));

            $(document).on("keyup mouseup", ".qty", function(arg){

                var id=$(this).attr('id');

                var number=id.split('qty')[1];
                if( $('#name'+number).val()==null ) {
                    alert("Select Product");


                }
                else {
                    var qty=$('#qty'+number).val();
                    var stock=$('#stock'+number).val();
                    var price=$('#price'+number).val();
                    if (qty<1 && qty!=''){
                        $('#qty'+number).val(1);
                        $('#total_price'+number).val(parseFloat(price).toFixed(2));
                    }



                    if ((isNaN(parseFloat(qty).toFixed(2))==false && isNaN(parseFloat(price).toFixed(2))==false )&& (parseFloat(parseFloat(qty).toFixed(2))> parseFloat(parseFloat(stock).toFixed(2) ))){
                        $('#qty'+number).val(stock);
                        // alert(isNaN(parseFloat(qty).toFixed(2)));
                    // alert(parseFloat(parseFloat(qty).toFixed(2))> parseFloat(parseFloat(stock).toFixed(2) ));

                        var total=Number(price) * Number($('#qty'+number).val());
                        $('#total_price'+number).val(parseFloat(total).toFixed(2));

                        alert("selected quantity is greater than the existing available stock quantity");
                    }
               else {
                        if(qty=='' || isNaN(qty)  ||  price=='' || isNaN(price) ){
                            $('#total_price'+number).val(0);

                        }
                        else {
                            var total=Number(price) * Number(qty);
                            $('#total_price'+number).val(parseFloat(total).toFixed(2));

                        }
                    }

                }





            });


            $(document).on("keyup mouseup", ".price", function(arg){

                var id=$(this).attr('id');

                var number=id.split('price')[1];
                if( $('#name'+number).val()==null ) {
                    alert("Select Product");


                }
                else {
                    var qty=$('#qty'+number).val();
                    var price=$('#price'+number).val();
                    if(qty=='' || isNaN(qty)  ||  price=='' || isNaN(price) ){
                        $('#total_price'+number).val(0);

                    }
                    else {
                        var total=Number(price) * Number(qty);
                        $('#total_price'+number).val(parseFloat(total).toFixed(2));

                    }

                }





            });

            $(document).ready(function(){

                $('.name').change(function(){
                    var id=$(this).attr('id');
                    var id=id.split('name')[1];


                    var selectproduct = $(this).children("option:selected").val();

                    $.ajax({
                        url: "{{ route('getproduct') }}",
                        type: "POST",
                        data: {
                            id: selectproduct,
                            "_token": "{{ csrf_token() }}",
                        },


                        success: function (data) {

                            var stock =(data.stock);
                            if (stock<1){
                                $('#stock'+id).val('');
                                $('#qty'+id).val('');
                                $('#price'+id).val('');
                                $('#total_price'+id).val('');

                                // $('#name'+id).closest('tr').remove();

                                alert("Product is Out-of-Stock");
                            }
                            else {
                                var price =(data.price);
                                var quantity =(data.quantity);
                                $('#stock'+id).val(stock);
                                $('#qty'+id).val(1);
                                var oneprice=parseFloat(price/quantity).toFixed(2);

                                $('#price'+id).val(oneprice);
                                var total_pr=1*Number(oneprice);
                                $('#total_price'+id).val(total_pr);
                            }





                        },
                        error: function(error)
                        {
                            alert('failed');
                            console.log(error);
                        }
                    });




                });


                var i = 0;
                $('#add_new').click(function(){

                    ++i;
                    $('#mainbody').append('<tr><td>' +
                        ' <select class="name form-control " id="name'+i+'" name="addmore['+i+'][name]" style="" required>'+
                       ' <option selected disabled value="">Select Product</option>'+
                '@foreach($products as $product)'+
                        '<option value="{{ $product->id }}">{{ $product->name}} </option>'+
          ' @endforeach'+
                '</select></td>' +
'</td>' +
                        '<td><input readonly class="stock col-sm col-form-label" type="number" step="any" name="addmore['+i+'][stock]" id="stock'+i+'" required ></td>' +
                        '<td><input class="qty col-sm col-form-label" type="number" step="any"  name="addmore['+i+'][qty]" id="qty'+i+'" value="" required></td>' +
                        '<td><input class="price col-sm col-form-label" type="number" step="any" name="addmore['+i+'][price]" id="price'+i+'" value="" required></td>' +
                        '<td><input class="total_price col-sm col-form-label" type="number" step="any" name="addmore['+i+'][total_price]" id="total_price'+i+'" value="" required></td>' +
                        '<td><button type="button" name="remove" id="remove" value="remove" class="btn btn-sm btn-danger">-</button></td></tr>');

                    $('#name'+i).select2();

                    $('.name').change(function(){
                        var id=$(this).attr('id');
                        var id=id.split('name')[1];


                        var selectproduct = $(this).children("option:selected").val();

                        $.ajax({
                            url: "{{ route('getproduct') }}",
                            type: "POST",
                            data: {
                                id: selectproduct,
                                "_token": "{{ csrf_token() }}",
                            },


                            success: function (data) {

                                var stock =(data.stock);
                                if (stock<1){
                                    $('#stock'+id).val('');
                                    $('#qty'+id).val('');
                                    $('#price'+id).val('');
                                    $('#total_price'+id).val('');
                                    $(this).closest('tr').remove();
                                    // $('#name'+id).closest('tr').remove();

                                    alert("Product is Out-of-Stock");


                                }
                                else {
                                    var price =(data.price);
                                    var quantity =(data.quantity);
                                    $('#stock'+id).val(stock);
                                    $('#qty'+id).val(1);
                                    var oneprice=parseFloat(price/quantity).toFixed(2);

                                    $('#price'+id).val(oneprice);
                                    var total_pr=1*Number(oneprice);
                                    $('#total_price'+id).val(total_pr);
                                }



                            },
                            error: function(error)
                            {
                                alert('failed');
                                console.log(error);
                            }
                        });




                    });


                    $('#mainbody').on('click', '#remove', function(){
                        $(this).closest('tr').remove();
                    });

                });







            });


            @endif
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                {{--url: "{{ route('admin.permissions.massDestroy') }}",--}}
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('permission_delete')
            dtButtons.push(deleteButton)
            @endcan

            $('.datatable:not(.ajaxTable)').DataTable({buttons: dtButtons})
        })


        // for data insert azax submit


    </script>
@endsection

@endsection





