@extends('layout.app')
@section('content')

<div class="card">
    <div class="card-header">
        Tambah Transaksi Pembelian
    </div>
    <div class="card-body">
        <form action="{{route('purchase.create')}}" method="post">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">Pilih Barang</div>
                    <div class="col-md-2">Kuantitas</div>
                    <div class="col-md-3">Harga Satuan</div>
                    <div class="col-md-3">Sub Total</div>
                    <div class="col-md-2"></div>
                </div>
                <div id="product-wrapper" class="full hide"></div>
            </div>
            <br>
            <div>Total: <span id="count-total"></span></div>
            <br>
            <div class="col-md-12 text-center">
                <button type="button" id="add-product" class="btn btn-primary">Tambah Barang</button>
                <button class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        var i = 1;
        var products = @json($products);
        $("#add-product").click(function() {                
            var item = $("<div>", {
                css: {
                    "margin-top": "15px"
                },
                class: "row"
            });
            var col4Product = $("<div>", {
                class: "col-md-3"
            });
            var col4Qty = $("<div>", {
                class: "col-md-2"
            });
            var col4Price = $("<div>", {
                class: "col-md-3"
            });
            var col4SubTotal = $("<div>", {
                class: "col-md-3",
                id: "sub-total_"+i
            });
            var col4Action = $("<div>", {
                class: "col-md-2"
            });
            var selectProduct = $("<select>", {
                type: "select",
                name: "product_"+i,
                id: "product_"+i,
                class: "form-control select2 product-select",
                onChange: "select(this)"
            });
            var inputQty = $("<input>", {
                type: "number",
                min: 0,
                name: "qty_"+i,
                id: "qty_"+i,
                class: "form-control",
                onChange: "subTotal(this)"
            });
            
            var price = $("<input>", {
                id: "price_"+i,
                class: "form-control",
                name: "price_"+1,
                onChange: "changePrice(this)"
            });

            var button = $("<button>", {
                type: "button",
                onClick: "remove(this)",
                class: "btn btn-danger"
            });
            $("#product-wrapper").removeClass("hide");

            var option = $("<option>");
            option.html("Pilih Barang");
            option.val("0");
            selectProduct.append(option);

            products.map(function(p){
                var id = p.id;
                var name = p.nama_barang;
                var option = $("<option>");
                option.html(name);
                option.val(id);
                selectProduct.append(option);
            });
            
            col4Product.append(selectProduct);
            col4Qty.append(inputQty);
            col4Price.append(price);
            
            item.append(col4Product);
            item.append(col4Qty);
            item.append(col4Price);
            item.append(col4SubTotal);
            button.html("Hapus");
            item.append(button);
            $("#product-wrapper").append(item);

            i = i+1;
        });
    });
</script>
<script>
    function remove(elem){
        $(elem).parent('div').remove();
    }
</script>
<script>
    function select(elem){
        var val = $("#"+elem.id).children("option:selected").val();
        console.log(val);
        var APP_URL = {!! json_encode(url('/')) !!};
        var url = APP_URL+"/products/"+val+"/get";
        console.log(url);
        $.ajax({  
            type: "GET",
            url: url,       
            success: function (data) {
                var split = elem.id.split("_");
                var id = split[1];
                var nodeId = "price_"+id;
                $("#"+nodeId).val(data.harga_satuan);
            }
        });
        
    }
</script>
<script>
    function subTotal(elem){
        var val = $("#"+elem.id).val();
        var str = elem.id;
        var split = str.split("_");
        var id = split[1];
        var subTotal = val * $("#price_"+id).val();
        $("#sub-total_"+id).html(subTotal);
        console.log(subTotal);
    }
</script>
<script>
    $(".card-body").click(function(){
        var child = $("#product-wrapper").children();
        var count = child.length;
        var arrPrice = [];
        for(var i = 1; i <= count; i++){
            var price = $("#sub-total_"+i).val();
            arrPrice.push(price);
        }
        var countTotal = 0;
        for(var n = 0; n < arrPrice.length; n++){
            countTotal = countTotal+parseFloat(arrPrice[n]);
        }
        $("#count-total").html(countTotal);
    });
</script>

@endsection