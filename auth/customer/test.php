<div id="pricelist">
    <input type="checkbox" id="item_1" value="item_1" price="1.5" /><label for="item_1">item_1</label><br/>
    <input type="checkbox" id="item_2" value="item_2" price="2" /><label for="item_2">item_2</label><br/>
    <input type="checkbox" id="item_3" value="item_3" price="3.5" /><label for="item_3">item_3</label><br/>
    <input type="checkbox" id="item_4" value="item_4" price="4" /><label for="item_4">item_4</label><br/>
    <input type="checkbox" id="item_5" value="item_5" price="5" /><label for="item_5">item_5</label><br/>
    <input type="checkbox" id="item_6" value="item_6" price="6.5" /><label for="item_6">item_6</label><br/>
    <input type="checkbox" id="item_7" value="item_7" price="7" /><label for="item_7">item_7</label><br/>
    <input type="checkbox" id="item_8" value="item_8" price="8" /><label for="item_8">item_8</label><br/>
    <input type="checkbox" id="item_9" value="item_9" price="9.5" checked="checked" /><label for="item_9">item_9</label>
</div>
<input type="text" id="total" value="0" readonly="readonly" />
<script type="text/javascript" src="../../asset/js/jquery.js"></script>

<script type="text/javascript">
    function calcAndShowTotal(){
        var total = 0;
        $('#pricelist :checkbox[checked]').each(function(){
            total += parseFloat($(this).attr('price')) || 0;
        });
        $('#total').val(total);
    }

    $('#pricelist :checkbox').click(function(){
        calcAndShowTotal();
    });

    calcAndShowTotal();
</script>