<?php

    function clusterTotalNumberofItemsARMSS(){
        $division = ["ACD", "FAD-Accounting", "FAD-Budget", "FAD-GSS", "FAD-Personnel", "FAD-Property", "IDD", "MISD", "PCMD"];
        $ppe_count =  App\View_PPE_Items::whereIn('division', $division)->whereNull('deleted_at')->count('id');
        return $ppe_count;

    }   

    function clusterTotalNumberofItemsRD(){
        $division = ["ARMRD", "CRD", "FERD", "IARRD", "LRD", "MRRD", "SERD", "TTPD"];
        $ppe_count =  App\View_PPE_Items::whereIn('division', $division)->whereNull('deleted_at')->count('id');
        return $ppe_count;
    }   

    function getItemsCount($division)
    {
        $ppe_count = App\View_PPE_Items::where('division', $division)->whereNull('deleted_at')->count('id');
        $sp_count = App\View_ICS_Items::where('division', $division)->whereNull('deleted_at')->count('id');
        return $ppe_count + $sp_count;   
    }

    function getPPETotalCostJanuary()
    {
        $equip = App\View_PPE_Items::select('amount');
        $sum = $equip->where('deleted_at',null)->sum('amount');
        return $sum;   
    }

    function getICSTotalCostJanuary()
    {
        $equip = App\View_ICS_Items::select('unit_cost');
        $sum = $equip->where('deleted_at',null)->sum('unit_cost');
        return $sum;   
    }


    function getTotalDashboardStatus($status)
    {
        $ppe = App\View_PPE_Items::all()->whereNull('deleted_at')->where('status',$status)->count();
        $sp = App\View_ICS_Items::all()->whereNull('deleted_at')->where('status',$status)->count();
        $total = $ppe + $sp;
        return $total; 
    }

    function getTotalItems()
    {
        $ppe = App\View_PPE_Items::all()->whereNull('deleted_at')->count();
        $sp = App\View_ICS_Items::all()->whereNull('deleted_at')->count();

        return $ppe + $sp;
    }

    function getTotaCost()
    {
        $equip = App\View_PPE_Items::select('amount');
        $equip2 = App\View_ICS_Items::select('unit_cost');

        $count1 = $equip->where('deleted_at',null)->sum('amount');
        $count2 = $equip2->where('deleted_at',null)->sum('unit_cost');

        $sum = $count1 + $count2;

        return number_format($sum, 2);
    }

    function getDivision($id)
    {
        $div = App\Division::where('division_id',$id)->first();
        return $div['division_acro'];
    }


    function getStaffInfo($empcode,$type = null)
    {
        $user = App\View_Users::where('username',$empcode)->first();

        if(isset($user))
        {
            switch ($type) {

            case 'fullname':
                $name = $user->fullname;
                return $name;
            break;
        
            }
        }
    }

    function getResponsibilityCenterCode($division)
    {
        $division = App\Division::where('division_acro',$division)->first();
        return $division['responsibility_center_code'];
    }

  
?>