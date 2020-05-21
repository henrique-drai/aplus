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
