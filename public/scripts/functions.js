
$('div.alert').not('.alert-important').delay(3000).slideUp(300);

$('#selectElectorate').select2({
    placeholder: 'Choose Electorate(s)'
});
$('#selectArea').select2({
    placeholder: 'Choose Area Units(s)'
});
$('#selectOccupation').select2({
    placeholder: 'Choose Occupation(s)'
});

$("table.table").floatThead()
