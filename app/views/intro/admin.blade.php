@section("content")
<form onsubmit="return false;" class="form-horizontal">
<h2>Общая информация</h2>

<div class="form-group">
    <label for="hostname" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.device_name')}}<a
            href="#"><span
            class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="return false;" type="text" class="form-control" id="hostname" placeholder="" value="{{$admin->hostname}}">

<!--         <div class="validation-error">
            Допускаются только латинские символы и буквы
        </div> -->
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>
<div class="form-group">
    <label for="location" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.device_location')}}<a
            href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="return false;" type="text" class="form-control" id="location" value="{{$admin->location}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>
<div class="form-group">
    <label for="contacts" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.contacts')}}<a href="#"><span
            class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="return false;" type="text" class="form-control" id="contacts" value="{{$admin->contacts}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>

<h2>{{Lang::get('admin.users')}}</h2>

<table class="users">
    <tr>
        <th>
            №
        </th>
        <th>
            {{Lang::get('admin.username')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.password')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.access_level')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.remove')}}
        </th>
    </tr>
    
    <tbody class="users_table_tbody">
    </tbody>

    <tr>
        <td colspan="5" class="text-right table-no-border">
            <a class="btn btn-default" onclick="addUser();" ><span class="fa fa-plus"></span> {{Lang::get('admin.add')}}</a>
        </td>
    </tr>
</table>
<h2>{{Lang::get('admin.access_config')}}</h2>

<div class="form-group">
    <label for="access_read" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.access_read')}}<a
            href="#"><span
            class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="return false;" type="text" class="form-control" id="access_read" value="{{$admin->access_read}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>

<div class="form-group">
    <label for="access_write" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.access_write')}}<a
            href="#"><span
            class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="return false;" type="text" class="form-control" id="access_write" value="{{$admin->access_write}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>
<div class="form-group">
    <label for="access_filter" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.access_filter')}}<a
            href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <input onkeyup="return false;" type="text" class="form-control" id="access_filter" value="{{$admin->access_filter}}" placeholder="">

        <div class="validation-error">

        </div>
    </div>
    <hr class="col-sm-12 col-md-8"/>
</div>

<table class="users subnet_table">
    <tr>
        <th>
            №
        </th>
        <th>
            {{Lang::get('admin.access_subnet')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.remove')}}
        </th>
    </tr>

    <tbody class="subnets_table_tbody">    
        @foreach($admin_access_subnet as $subnet)
        <tr id="subnet_{{$subnet->id}}" data-id="{{$subnet->id}}">
            <td class="text-center">{{$subnet->id}}</td>
            <td><input type="text" value="{{$subnet->subnet}}" class="form-control subnet" onkeyup="return false;allSubnetSave();" /></td>
            <td class="text-center"><span class="fa fa-times" onclick="removeSubnet({{$subnet->id}});"></span></td>
        </tr>
        @endforeach
    </tbody>

    <tr>
        <td colspan="3" class="text-right table-no-border">
            <a class="btn btn-default" onclick="addSubnet();"><span class="fa fa-plus"></span> {{Lang::get('admin.add')}}</a>
        </td>
    </tr>

</table>
<h2>{{Lang::get('admin.ntp_config')}}</h2>

<div class="form-group">
<label for="timezone" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.timezone')}}<a
        href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

<div class="col-sm-6 col-md-4">

    <select class="form-control" onchange="changeTimeZone();" id="timezone">
        <option value="-12.0"> (GMT -12:00) Эниветок, Кваджалейн </option>
        <option value="-11.0"> (GMT -11:00) Остров Мидуэй, Самоа </option>
        <option value="-10.0"> (GMT -10:00) Гавайи </option>
        <option value="-9.0"> (GMT -9:00) Аляска </option>
        <option value="-8.0"> (GMT -8:00) Тихоокеанское время (США и Канада) </option>
        <option value="-7.0"> (GMT -7:00) Горное время (США и Канада) </option>
        <option value="-6.0"> (GMT -6:00) Центральное время (США и Канада), Мехико</option>
        <option value="-5.0"> (GMT -5:00) Восточное время (США и Канада), Богота, Лима </option>
        <option value="-4.0"> (GMT -4:00) Атлантическое время (Канада), Каракас, Ла-Пас </option>
        <option value="-3.5"> (GMT -3:30) Ньюфаундленд </option>
        <option value="-3.0"> (GMT -3:00) Бразилия, Буэнос-Айрес, Джорджтаун </option>
        <option value="-2.0"> (GMT -2:00) Срединно-Атлантического </option>
        <option value="-1.0"> (GMT -1:00 час) Азорские острова, острова Зеленого Мыса </option>
        <option value="0.0"> (GMT) Время Западной Европе, Лондон, Лиссабон, Касабланка </option>
        <option value="1.0"> (GMT +1:00 час) Брюссель, Копенгаген, Мадрид, Париж </option>
        <option value="2.0"> (GMT +2:00) Киев, Калининград, Южная Африка </option>
        <option value="3.0"> (GMT +3:00) Багдад, Эр-Рияд, Москва, Санкт-Петербург</option>
        <option value="3.5"> (GMT +3:30) Тегеран </option>
        <option value="4.0"> (GMT +4:00) Абу-Даби, Мускат, Баку, Тбилиси</option>
        <option value="4.5"> (GMT +4:30) Кабул </option>
        <option value="5.0"> (GMT +5:00) Екатеринбург, Исламабад, Карачи, Ташкент</option>
        <option value="5.5"> (GMT +5:30) Бомбей, Калькутта, Мадрас, Нью-Дели</option>
        <option value="5.75"> (GMT +5:45) Катманду</option>
        <option value="6.0"> (GMT +6:00) Алматы, Дакке, Коломбо </option>
        <option value="7.0"> (GMT +7:00) Бангкок, Ханой, Джакарта</option>
        <option value="8.0"> (GMT +8:00) Пекин, Перт, Сингапур, Гонконг</option>
        <option value="9.0"> (GMT +9:00) Токио, Сеул, Осака, Саппоро, Якутск</option>
        <option value="9.5"> (GMT +9:30) Аделаида, Дарвин </option>
        <option value="10.0"> (GMT +10:00) Восточная Австралия, Гуам, Владивосток </option>
        <option value="11.0"> (GMT +11:00) Магадан, Соломоновы острова, Новая Каледония</option>
        <option value="12.0"> (GMT +12:00) Окленд, Веллингтон, Фиджи, Камчатка</option>
    </select>










</div>
<hr class="col-sm-12 col-md-8"/>
</div>
<table class="users ntp_table">
    <tr>
        <th>
            №
        </th>
        <th>
            {{Lang::get('admin.ntp_server')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.status')}}<a href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a>
        </th>
        <th>
            {{Lang::get('admin.remove')}}
        </th>
    </tr>

    <tbody class="ntp_table_tbody">
        @foreach($admin_ntp_servers as $server)
        <tr id="ntp_{{$server->id}}" data-id="{{$server->id}}">
            <td class="text-center">{{$server->id}}</td>
            <td><input type="text" onkeyup="return false;allNtpSave();" class="form-control ntp" value="{{$server->ntp_server}}"/></td>
            <td class="text-center"><span class="italic">{{Lang::get('admin.not_connect')}}</span>
                <a class="btn btn-default refresh" onclick="javascript:ntpRefresh({{$server->id}});"><span class="fa fa-refresh"></span></a>
            </td>
            <td class="text-center"><span class="fa fa-times" onclick="removeNtp({{$server->id}});"></span></td>
        </tr>
        @endforeach
    </tbody>

    <tr>
        <td colspan="4" class="text-right table-no-border">
            <a class="btn btn-default" onclick="addNtp();"><span class="fa fa-plus"></span> {{Lang::get('admin.add')}}</a>
        </td>
    </tr>
</table>
<h2>{{Lang::get('admin.rtc')}}</h2>

<div class="form-group">
    <label for="date" class="col-sm-6 col-md-4 control-label text-left">{{Lang::get('admin.date_time')}}<a
            href="#"><span class="form-question fa fa-question" data-toggle="tooltip"  title="some tooltip"></span></a></label>

    <div class="col-sm-6 col-md-4">
        <p class="form-control-static"><span id="showDate">{{date("d.m.Y",time() - $admin->datetime_offset)}}</span>, <span id="showTime">{{date("G:i:s",time() - $admin->datetime_offset)}}</span>
            <a class="btn btn-default datetime-edit" onclick="showChangeDateTime();"><span class="fa fa-pencil"></span></a>
        </p>

        <div class="row hidden" id="datetime">
            <div class="col-xs-5">
                <input onkeyup="dateTimeChange()" type="text" class="form-control input-sm" id="date" value="" placeholder="">
            </div>
            <div class="col-xs-5">
                <input onkeyup="dateTimeChange()" type="text" class="form-control input-sm" id="time" value="" placeholder="">
            </div>
            <div class="col-xs-2">
                <a class="btn btn-default btn-sm" onclick="hideChangeDateTime()"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>
</div>
<div class="validation-error">

</div>

<div class="row">
    <div class="col-sm-12 col-md-8">       
        <hr/>      
        <input type="submit" onclick="saveSettings()" class="btn btn-primary" value="{{Lang::get('admin.apply')}}"/>        
    </div>     
</div>

</form>
</div>
@stop

@section("add_js")
<script type="text/javascript">


var datetime_offset = parseInt({{$admin->datetime_offset}})*1000;

var current_timezone = '{{$admin->timezone}}';


$(document).ready(function()
{
    $.each($("#timezone option"),function(index,value)
    {
        if( $(value).val() == '{{$admin->timezone}}' )
        {
            $("#timezone").val('{{$admin->timezone}}');
        }
    });

    //запускаем часы
    startTime();
});


//анимация часов
var t;
function startTime()
{
    console.log("startTime");

    var currentTime = (Date.now() - (datetime_offset) );
    var tm=new Date(currentTime);
    var h=tm.getHours();
    var m=tm.getMinutes();
    var s=tm.getSeconds();
    m=checkTime(m);
    s=checkTime(s);

    $("#showTime").html( h+":"+m+":"+s );
    $("#time").html( h+":"+m+":"+s );

    t=setTimeout('startTime()',500);
}

function checkTime(i)
{
    if (i<10)
    {
    i="0" + i;
    }
    return i;
}
//

function saveSettings()
{
 console.log("saveSettings");

    generateUsers(getAllUsers());

    var jsonData = {};

    jsonData.hostname = $("#hostname").val();
    jsonData.location = $("#location").val();
    jsonData.contacts = $("#contacts").val();
    jsonData.access_read = $("#access_read").val();
    jsonData.access_write = $("#access_write").val();
    jsonData.access_filter = $("#access_filter").val();
    jsonData.timezone = $("#timezone option:selected").val();
    jsonData.datetime_offset = parseInt( datetime_offset / 1000 );

    $.ajax({
        url:"admin/save",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });

    //subnets
    allSubnetSave();

    //ntps
    allNtpSave();

    //users
    allUsersSave();
}


function changeTimeZone()
{
    // TODO: здесь использовать библиотеку вроде этой:
    // http://yapro.ru/uploads/Files/jquery.yapro.Datepicker/index.html


    console.log($("#timezone option:selected").val() - current_timezone);
    return false;


    var diff_hours = $("#timezone option:selected").val() - current_timezone;

    var rawDate = $("#showDate").text();
    var rawTime = $("#showTime").text();

    var curDate = $("#date").val();
    var date_arr = rawDate.split(".");

    // console.log(date_arr);

    

    var time_api_arr = rawTime.split(":");
    var newTimeHours;
    var newTimeMinutes;


    var newDay;

    if( diff_hours )//если перевели вперед по времени
    {
        newTimeHours = parseFloat(time_api_arr[0]) + parseFloat(diff_hours);//изменяем количество часов
        if(newTimeHours.toString().split(".")[1] !=undefined)
        {
            newTimeHours = newTimeHours.toString().split(".")[0];
            newTimeMinutes = 30;            
        }
    }
    else//если перевели назад по времени
    {
        newTimeHours = parseFloat(time_api_arr[0]) + parseFloat(diff_hours);//изменяем количество часов
        if(newTimeHours.toString().split(".")[1] !=undefined)
        {
            newTimeHours = newTimeHours.toString().split(".")[0];
            newTimeMinutes = 30;
        }
    }
    // console.log(newTimeHours,newTimeMinutes);
    var tempNewHours =  parseFloat(time_api_arr[0])+diff_hours;
    if(tempNewHours >24)//переход на следующий день
    {
        tempNewHours =  tempNewHours - 24;
        if(newTimeMinutes == 30)
        {
            var tempNewMinutes = parseFloat(time_api_arr[1]) +30;
            if(tempNewMinutes >60)
            {
                tempNewMinutes = tempNewMinutes - 60;
                tempNewHours +=1;
                if(tempNewHours >24)
                {
                    tempNewHours = tempNewHours - 24;
                }
            }
        }
        newDay = parseInt(date_arr[0]) + 1;
    }
    else if(newTimeHours < 0 )//переход на предыдущий день
    {
        tempNewHours = 24+tempNewHours;//<24
        if(newTimeMinutes == 30)
        {
            var tempNewMinutes = parseFloat(time_api_arr[1]) -30;
            if(tempNewMinutes <0)
            {
                tempNewMinutes = 60 + tempNewMinutes;
                tempNewHours -=1;
                if(tempNewHours <0)
                {
                    tempNewHours = 24+tempNewHours;
                }
            }
        }
        newDay = parseInt(date_arr[0]) - 1;
    }
    console.log("tempNewHours",tempNewHours);


    var hours = tempNewHours;
    var minutes = parseFloat(time_api_arr[1]);//tempNewMinutes;


    // $("#datetime").removeClass("hidden");
    // $("#date").val( $("#showDate").text() );
    // $("#time").val( $("#showTime").text() );
    clearTimeout(t);
    $("#showTime").html(hours+":"+minutes);
    $("#showDate").html(newDay+"."+date_arr[1]+"."+date_arr[2]);
    // startTime();

    return false;
    var jsonData ={};
    // TODO: добавить случаи когда происходит переход на следующий месяц или на следующий год
    jsonData.api_date_time = date_arr[2]+date_arr[1]+date_arr[0]+tempNewHours+tempNewMinutes;

    //пробавляем поправку во времени к текущему времени и если надо переводим дату


    $.ajax({
        url:"admin/save/time",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });

}

function timeSave () {
    // console.log("timeSave",datetime_offset);
    var jsonData = {};
    jsonData.timezone = $("#timezone option:selected").val();
    jsonData.datetime_offset = parseInt( datetime_offset / 1000 );


    var rawDate = $("#showDate").text();
    var rawTime = $("#showTime").text();
    console.log("timeSave",rawDate,rawTime);

    var curDate = $("#date").val();
    var date_arr = rawDate.split(".");

    console.log(date_arr);

    var newDatetime = new Date(date_arr[1]+"/"+date_arr[0]+"/"+date_arr[2]+" "+ $("#time").val() );//+" "+$("#time").val()).getTime();

    var time_api = rawTime.replace(/:/g, "");
    console.log("newDatetime",date_arr[2]+date_arr[1]+date_arr[0]+time_api,time_api,rawTime);

    jsonData.api_date_time = date_arr[2]+date_arr[1]+date_arr[0]+time_api;


    $.ajax({
        url:"admin/save/time",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });
}

function allUsersSave () {

    var jsonData = {};
    jsonData.users = [];
    $.each($(".users_table_tbody tr"),function(index,value)
    {
        jsonData.users.push( { id:$(value).attr("data-id"), 
            username:$(value).find(".username").val(),
            password:$(value).find(".password").val(),
            hash_password:$(value).find(".hash_password").val(),
            access_level:$(value).find(".access_level").val()
         } );
        // console.log(index,value);
    });
    
    $.ajax({
        url:"admin/save/users",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });
}


function allSubnetSave()
{
    var jsonData = {};
    jsonData.subnets = [];
    $.each($(".subnets_table_tbody tr"),function(index,value)
    {
        jsonData.subnets.push( { id:$(value).attr("data-id"), 
            subnet:$(value).find(".subnet").val()
         } );
    });
    
    console.log(jsonData);
    // return false;

    $.ajax({
        url:"admin/save/subnets",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });
}

function allNtpSave()
{
    var jsonData = {};
    jsonData.ntps = [];
    $.each($(".ntp_table_tbody tr"),function(index,value)
    {
        jsonData.ntps.push( { id:$(value).attr("data-id"), 
            ntp:$(value).find(".ntp").val()
         } );
    });
    
    console.log(jsonData);
    // return false;

    $.ajax({
        url:"admin/save/ntps",
        method:"POST",
        data:jsonData,
        success:function(data)
        {
            console.log("ok");
        }
    });
}



var usersNum = {{count($admin_users) -1}};
function addUser()
{
    var newUser = {
            id:"",//getAllUsers().length+1, 
            username:"",
            password:"",
            hash_password:"",
            access_level:"guest",
            isNew:true
    };

    var users = getAllUsers();
    users.push(newUser);

    generateUsers(users);


    return false;


    usersNum++;
    var userRow = "<tr id=user_"+usersNum+" data-id='"+usersNum+"'>"+
        '<td class="text-center">'+usersNum+'</td>'+
        '<td><input type="text" onkeyup="return false;allUsersSave()" class="form-control username" value="" /></td>'+
        '<td><input type="password" value="" class="form-control password"/></td>'+
        '<td class="text-center">'+
            '<select class="form-control access_level" onchange="return false;allUsersSave()">'+
                "<option value='admin'>{{Lang::get('admin.access_level_admin')}}</option>"+
                "<option value='guest'>{{Lang::get('admin.access_level_guest')}}</option>"+
            '</select>'+
        "</td>"+
        '<td class="text-center"><span class="fa fa-times" onclick="removeUser('+usersNum+')"></span></td>'+
    "</tr>";

    $(".users_table_tbody").append(userRow);

    //send to server
    // allUsersSave();
}

function removeUser(id)
{
    // console.log("removeUser");
    var users = getAllUsers();

    // usersNum--;
    // $("#user_"+id).remove();

    var index = 0;
    for(var i in users )
    {
        console.log(users[i]);
        if(users[i].id == id)
        {
            delete users[index];
            console.log("remove");
        }
        index++;
    }
    console.log("users",users);
    generateUsers(users);

    //send to server
    // allUsersSave();
}

var subnetsNum = {{count($admin_access_subnet)}};
function addSubnet()
{
    subnetsNum++;

    var subnetRow = '<tr id="subnet_'+subnetsNum+'" data-id="'+subnetsNum+'">'+
        '<td class="text-center">'+subnetsNum+'</td>'+
        '<td><input type="text" onkeyup="return false;allSubnetSave();" value="" class="form-control subnet"/></td>'+
        '<td class="text-center"><span class="fa fa-times" onclick="removeSubnet('+subnetsNum+');"></span></td>'+
    '</tr>';

    $(".subnets_table_tbody").append(subnetRow);

    //send to server
    allSubnetSave();
}

function removeSubnet(id)
{
    subnetsNum--;
    $("#subnet_"+id).remove();

    //send to server
    allSubnetSave();
}


var ntpNum = {{count($admin_ntp_servers)}};
function addNtp()
{
    ntpNum++;

    var ntpRow = '<tr id="ntp_'+ntpNum+'" data-id="'+ntpNum+'">'+
            '<td class="text-center">'+ntpNum+'</td>'+
            '<td><input type="text" onkeyup="return false;allNtpSave();" class="form-control ntp" value=""/></td>'+
            "<td class='text-center'><span class='italic'>{{Lang::get('admin.not_connect')}}</span>"+
                '<button class="refresh" onclick="javascript:ntp_refresh('+ntpNum+');"><span class="fa fa-refresh"></span></button>'+
            '</td>'+
            '<td class="text-center"><span class="fa fa-times" onclick="removeNtp('+ntpNum+')"></span></td>'+
        '</tr>';


    $(".ntp_table_tbody").append(ntpRow);

    //send to server
    allNtpSave();
}

function removeNtp(id)
{
    console.log("removeNtp");
    ntpNum--;
    $("#ntp_"+id).remove();

    //send to server
    allNtpSave();
}

function ntpRefresh(id)
{
    console.log("ntpRefresh");
}

function showChangeDateTime()
{
    $("#datetime").removeClass("hidden");
    $("#date").val( $("#showDate").text() );
    $("#time").val( $("#showTime").text() );
    clearTimeout(t);
}

function hideChangeDateTime()
{
    $("#datetime").addClass("hidden");

    var curDate = $("#date").val();
    var date_arr = curDate.split(".");

    console.log(date_arr);

    var newDatetime = new Date(date_arr[1]+"/"+date_arr[0]+"/"+date_arr[2]+" "+ $("#time").val() );//+" "+$("#time").val()).getTime();
    

    datetime_offset = Date.now() - newDatetime;

    console.log(curDate,datetime_offset);

    startTime();

    timeSave();
}

function dateTimeChange()
{
    console.log("dateTimeChange");
    $("#showDate").html( $("#date").val() );
    $("#showTime").html( $("#time").val() );

    // ;
}


$(function()
{
    init();
});


function init()
{
    var users = {{$admin_users}};

    for(var i in users)
    {
        users[i].hash_password = users[i].password;
    }

    generateUsers(users);
}

function generateUsers(users)
{
    $(".users_table_tbody").html("");
    var userId=0;
    var isGuest="";
    for(var index in users)
    {
        if(users[index].isNew )
        {

            isGuest ="<option value='admin'>{{Lang::get('admin.access_level_admin')}}</option>"+
                        "<option value='guest'>{{Lang::get('admin.access_level_guest')}}</option>";


            if( users[index].access_level =="guest")
            {
                isGuest ="<option value='admin'>{{Lang::get('admin.access_level_admin')}}</option>"+
                "<option value='guest' selected='selected'>{{Lang::get('admin.access_level_guest')}}</option>";                
            }

            var userRow = "<tr id=user_"+userId+" data-id='"+userId+"'>"+
                '<td class="text-center">'+userId+'</td>'+
                '<td><input type="text" onkeyup="return false;allUsersSave()" class="form-control username" value="'+users[index].username+'"/></td>'+
                '<td><input type="password" value="" placeholder="**************************" class="form-control password"/> <input type="hidden" class="hash_password" value="'+users[index].hash_password+'" </td>'+
                '<td class="text-center">'+
                    '<select class="form-control access_level" onchange="return false;allUsersSave()">'+
                        isGuest+
                        // "<option value='admin'>{{Lang::get('admin.access_level_admin')}}</option>"+
                        // "<option value='guest'>{{Lang::get('admin.access_level_guest')}}</option>"+
                    '</select>'+
                "</td>"+
                '<td class="text-center"><span class="fa fa-times" onclick="removeUser('+userId+')"></span></td>'+
            "</tr>";
        }
        else
        {

            isGuest ="<option value='admin'>{{Lang::get('admin.access_level_admin')}}</option>"+
                        "<option value='guest'>{{Lang::get('admin.access_level_guest')}}</option>";

            if( users[index].access_level =="guest")
            {
                isGuest ="<option value='admin'>{{Lang::get('admin.access_level_admin')}}</option>"+
                "<option value='guest' selected='selected'>{{Lang::get('admin.access_level_guest')}}</option>";                
            }


            var userRow = "<tr id=user_"+userId+" data-id='"+userId+"'>"+
                '<td class="text-center">'+userId+'</td>'+
                '<td><input type="text" onkeyup="return false;allUsersSave()" class="form-control username" disabled="disabled" value="'+users[index].username+'"/></td>'+
                '<td><input type="password" value="" placeholder="**************************" class="form-control password"/> <input type="hidden" class="hash_password" value="'+users[index].hash_password+'" </td>'+
                '<td class="text-center">'+
                    '<select class="form-control access_level" onchange="return false;allUsersSave()">'+
                        isGuest+
                        // "<option value='admin'>{{Lang::get('admin.access_level_admin')}}</option>"+
                        // "<option value='guest'>{{Lang::get('admin.access_level_guest')}}</option>"+
                    '</select>'+
                "</td>"+
                '<td class="text-center"><span class="fa fa-times" onclick="removeUser('+userId+')"></span></td>'+
            "</tr>";
        }

        $(".users_table_tbody").append(userRow);
        userId++;
    }
}

function getAllUsers()
{
    var users = [];
    $.each($(".users_table_tbody tr"),function(index,value)
    {
        users.push( 
            { id:$(value).attr("data-id"), 
            username:$(value).find(".username").val(),
            password:$(value).find(".password").val(),
            hash_password:$(value).find(".hash_password").val(),
            access_level:$(value).find(".access_level").val()
         } );
    });
    

    return users;
}

</script>


@stop