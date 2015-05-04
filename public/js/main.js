//全域變數
var gamedata,
    date = [],
    id = [],
    odate = [],
    oid = [],
    BASE_URL = location.protocol + '//' + location.hostname;

var createTmp = function(){
    $('#gameNum').load('public/gameNum.html',function(){
        for (var key in date) {
            var tem = '<option value="'+id[key]+':'+date[key]+'" selected>'+id[key]+':'+date[key]+'</option>';
            $('.GAMEDATE').append(tem);
        }
        $(document).on("click",".submit",function(){
            var idNum = $('.GAMEDATE').val().slice(0, 1);
            var IDvalue = idNum;
            var NUM1value = $('.NUM1').val();
            var NUM2value = $('.NUM2').val();
            var NUM3value = $('.NUM3').val();
            var NUM4value = $('.NUM4').val();
            var NUM5value = $('.NUM5').val();
            var NUM6value = $('.NUM6').val();
            var NUM7value = $('.NUM7').val();
            gamedata = {
                id : IDvalue,
                num1 : NUM1value,
                num2 : NUM2value,
                num3 : NUM3value,
                num4 : NUM4value,
                num5 : NUM5value,
                num6 : NUM6value,
                num7 : NUM7value
            }
            gameNum();
        });
    });
}
//開獎結果送出
$(document).on("click",".submitResult",function(){
    var idResult = $('.GAMERESULT').val().slice(0, 1);
    result(idResult);
})
//寫入開獎號碼
var gameNum = function() {
    $.ajax({
        url: BASE_URL + "/gameNum",
        type: "POST",
        dataType: "JSON",
        data: gamedata,
        success: function (response) {
            console.log(response)
            if (response.status == 'error1') {
                alert('失敗，請輸入數字！');
            } else if (response.status == 'error2') {
                alert('失敗，請輸入1~49的數字！');
            } else if (response.status == 'error3') {
                alert('失敗，請輸入不重複的數字！');
            } else if (response.status == false) {
                alert('失敗，請重新輸入！');
            } else {
                cusResult();
            }
        }
    })
}
//寫入orders_result
var cusResult = function() {
    $.ajax({
        url: BASE_URL + "/cusResult",
        type: "POST",
        dataType: "JSON",
        data: gamedata,
        success: function (response) {
            $('#gameNum').hide();
            result(response.status);
        }
    })
}
//orders_result_list
var result = function(idResult) {
    $.ajax({
        url: BASE_URL + "/result",
        type: "get",
        dataType: "JSON",
        data: {id : idResult},
        success: function (response) {
            var title = ["id", "NUM1", "NUM2", "NUM3", "NUM4", "NUM5", "NUM6", "NUM7", "結果"];
            $('.result').html('');
            $('.result').append('中獎號碼 : ');
            for (var key in response.gameResult ) {
                $('.result').append(response.gameResult[key]+' ');
            }
            var $table = $('<table></table>');
            var $Tr = $('<tr class="title"></tr>');
            for (var m in title ) {
                var $Td = $('<td></td>');
                $Td.text(title[m]);
                $Tr.append($Td);
                $table.append($Tr);
                $('.result').append($table);
                m++;
            }
             for (var key in response.status ) {
                 var $Tr = $('<tr></tr>');
                 var $Td = $('<td class="b3" ColSpan=9 Align="Center"></td>');
                 $Td.text(response.status[key].date);
                 $table.append($Tr);
                 var $Tr = $('<tr></tr>');
                 var $Td = $('<td class="b1">'+response.status[key].id+'</td>');
                 $Tr.append($Td);
                 var $Td = $('<td class="b1">'+response.status[key].number1+'</td>');
                 $Tr.append($Td);
                 var $Td = $('<td class="b1">'+response.status[key].number2+'</td>');
                 $Tr.append($Td);
                 var $Td = $('<td class="b1">'+response.status[key].number3+'</td>');
                 $Tr.append($Td);
                 var $Td = $('<td class="b1">'+response.status[key].number4+'</td>');
                 $Tr.append($Td);
                 var $Td = $('<td class="b1">'+response.status[key].number5+'</td>');
                 $Tr.append($Td);
                 var $Td = $('<td class="b1">'+response.status[key].number6+'</td>');
                 $Tr.append($Td);
                 var $Td = $('<td class="b1">'+response.status[key].number7+'</td>');
                 $Tr.append($Td);
                 var $Td = $('<td class="b1">'+response.status[key].result+'</td>');
                 $Tr.append($Td);
                 $table.append($Tr);
                 $('.result').append($table);

             }
        }
    })
}
//取gameid for 期數顯示
var gameid = function() {
    $.ajax({
        url: BASE_URL + "/gameid",
        type: "GET",
        dataType:'json',
        success: function (response) {
            for (var key in response.status ) {
                if (response.status[key]['num1']>0) {
                    oid.push(response.status[key]['id']);
                    odate.push(response.status[key]['date']);
                } else {
                    id.push(response.status[key]['id']);
                    date.push(response.status[key]['date']);
                }
            }
            createTmp();
            for (var key in odate) {
                var tem = '<option value="'+oid[key]+':'+odate[key]+'" selected>'+oid[key]+':'+odate[key]+'</option>';
                $('.GAMERESULT').append(tem);

            }
        }
    });
}

gameid();

  
