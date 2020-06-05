// ficheiro global de js com as funções globais para as páginas de aluno e professor de projeto

function dateFormatter(date){
    //formato desejado é dd/mm/yyyy hh:mm
    d1 = date.toString().split(" ");

    month = "0" + (date.getMonth() + 1); //month é 0-indexed
    day = d1[2];
    year = d1[3];
    hhmmss = d1[4].split(":")[0] + ":" + d1[4].split(":")[1];

    return day+"/"+month.slice(-2)+"/"+year+" "+hhmmss;
}


function dateFromPicker(date){
    //vem na seguinte forma dd/mm/yyyy hh:mm em string

    if(date == "" || date == undefined){
        return "";
    } else {
        d1 = date.split(" ");
        d2 = d1[0].split("/");
        dh = d1[1].split(":");
    
        day = d2[0];
        month = d2[1];
        year = d2[2];
    
        hh = dh[0];
        mm = dh[1];

        var final_date = new Date(year, month-1, day, hh, mm);
        var timezoneMS = final_date.getTimezoneOffset() * 60000;
        final_date.setTime(final_date.getTime() - timezoneMS);

        isoStr = final_date.toISOString();

        return isoStr.substring(0,isoStr.length-1);
    }

}