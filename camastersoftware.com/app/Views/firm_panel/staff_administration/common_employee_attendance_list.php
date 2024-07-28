<div class="row">
    <div class="offset-md-4 col-md-4 text-center">
        <h4>
            <span class="font-weight-bold">Office Time : </span>
            <span>
                <?php echo (!empty($settingsArr['officeStartTime'])) ? date('h:i A', strtotime($settingsArr['officeStartTime'])) : "N/A"; ?>
                &nbsp;-&nbsp;
                <?php echo (!empty($settingsArr['officeEndTime'])) ? date('h:i A', strtotime($settingsArr['officeEndTime'])) : "N/A"; ?>
            </span>
        </h4>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="data_tbl table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th width="5%">SN</th>
                        <th width="5%">Date</th>
                        <th width="5%">Day</th>
                        <th width="5%">In&nbsp;Time</th>
                        <th width="5%">Out&nbsp;Time</th>
                        <th width="5%">Hours</th>
                        <th width="5%">Place</th>
                        <th width="5%">Remarks</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php if(!empty($empAttendArray)): ?>
                        <?php foreach($empAttendArray AS $k_row => $e_row): ?>
                            <?php 
                                if(check_valid_date($e_row['attendanceDate']))
                                    $attendanceDate=date('d-m-Y', strtotime($e_row['attendanceDate']));
                                else 
                                    $attendanceDate="";
                                    
                                $dayNo=date('N', strtotime($attendanceDate)); 
                            ?>
                            <tr <?php if((in_array($e_row['attendanceDate'], $holidayDateArr)) || $dayNo==6 || $dayNo==7): ?>style="background: #00549545 !important;"<?php endif; ?> >
                                <td class="text-center" width="5%"><?php echo $i; ?></td>
                                <td class="text-center" width="5%" nowrap>
                                    <?php 
                                        if(!empty($attendanceDate))
                                            echo $attendanceDate;
                                        else 
                                            echo "-";
                                    ?>
                                </td>
                                <td class="text-center" width="5%" nowrap>
                                    <?php 
                                        if(!empty($attendanceDate))
                                            echo date('D', strtotime($attendanceDate));
                                        else 
                                            echo "-"; 
                                    ?>
                                </td>
                                <td class="text-center" width="5%" nowrap>
                                    <?php 
                                        if(!empty($e_row['inTime']))
                                            echo date('h:i A', strtotime($e_row['inTime']));
                                        else 
                                            echo "-"; 
                                    ?>
                                </td>
                                <td class="text-center" width="5%" nowrap>
                                    <?php 
                                        if(!empty($e_row['outTime']))
                                            echo date('h:i A', strtotime($e_row['outTime']));
                                        else 
                                            echo "-"; 
                                    ?>
                                </td>
                                <td class="text-center" width="5%" nowrap>
                                    <?php 
                                        if(!empty($e_row['totalHours']))
                                            $totalHoursVal = $e_row['totalHours'];
                                        else 
                                            $totalHoursVal = " "; 
                                    ?>
                                    <span class="<?php if($totalHoursVal<8): ?>text-danger<?php endif; ?>"><?= $totalHoursVal; ?></span>
                                </td>
                                <td class="text-center" width="5%" nowrap>
                                    <?php 
                                        if(!empty($e_row['workPlace']))
                                            echo $e_row['workPlace'];
                                        else 
                                            echo " "; 
                                    ?>
                                </td>
                                <td class="text-left" width="5%" nowrap>
                                    <span <?php if(!empty($e_row['remarks']) && strlen($e_row['remarks'])>45): ?> data-toggle="tooltip" data-original-title="<?= $e_row['remarks']; ?>" style="cursor: pointer;" <?php endif; ?>>
                                        <?php 
                                            if(!empty($e_row['remarks']))
                                            {
                                                if(strlen($e_row['remarks'])>45)
                                                {
                                                    echo substr($e_row['remarks'], 0, 45)."...";
                                                }
                                                else
                                                {
                                                    echo $e_row['remarks'];
                                                }
                                            }
                                            else
                                            {
                                                if(!empty($holidayNameArr[$e_row['attendanceDate']]))
                                                {
                                                    echo $holidayNameArr[$e_row['attendanceDate']];
                                                }
                                                else
                                                {
                                                    echo " ";
                                                }
                                            }
                                        ?>
                                    </span>
                                </td>
                                <td width="5%" class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btnPrimClr dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editEmpAttendModal<?php echo $k_row; ?>">Edit</a>
                                            <?php if(isset($e_row['employeeAttendanceId'])): ?>
                                                <a class="dropdown-item deleteEmpAttend" href="javascript:void(0);" data-id="<?= $e_row['employeeAttendanceId']; ?>">Delete</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>