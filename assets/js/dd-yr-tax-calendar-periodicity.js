$(document).ready(function(){
            
    $('#periodicityVal').on('change', function(){
        var periodicityVal = $(this).val();
        
        console.log('periodicityVal', periodicityVal);
        
        var filterFormVal = base_url;
        
        if(periodicityVal == 2)
        {
            filterFormVal = base_url+"due-date-yr-wise-mth-tax-calendar";
        }
        else if(periodicityVal == 3)
        {
            filterFormVal = base_url+"due-date-yr-wise-quarter-tax-calendar";
        }
        else if(periodicityVal == 4)
        {
            filterFormVal = base_url+"due-date-yr-wise-half-tax-calendar";
        }
        else if(periodicityVal == 5)
        {
            filterFormVal = base_url+"due-date-yr-wise-year-tax-calendar";
        }
        else
        {
            filterFormVal = base_url+"due-date-yr-wise-mth-tax-calendar";
        }
        
        $('#filterForm').attr('action', filterFormVal);
    });
});