$(document).ready(function(){
            
    $('#periodicityVal').on('change', function(){
        var periodicityVal = $(this).val();
        
        console.log('periodicityVal', periodicityVal);
        
        var filterFormVal = base_url;
        
        if(periodicityVal == 2)
        {
            filterFormVal = base_url+"act-wise-mth-tax-calendar";
        }
        else if(periodicityVal == 3)
        {
            filterFormVal = base_url+"act-wise-quarter-tax-calendar";
        }
        else if(periodicityVal == 4)
        {
            filterFormVal = base_url+"act-wise-half-tax-calendar";
        }
        else if(periodicityVal == 5)
        {
            filterFormVal = base_url+"act-wise-year-tax-calendar";
        }
        else
        {
            filterFormVal = base_url+"act-wise-mth-tax-calendar";
        }
        
        $('#filterForm').attr('action', filterFormVal);
    });
});