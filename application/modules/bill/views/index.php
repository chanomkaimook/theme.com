<div class="content">
    <div class="container-fluid">
        <div class="card">

            <div class="card-body tool-btn">
                <h4>quotation</h4>
                <?php if (get_permitPath(array("bill/ctl_quotation","bill/ctl_bill"))) { ?> <button class="btn">ดู quotation</button><?php } ?>
                    
                
                <?php if (get_permitPath("bill/ctl_quotation/insert")) { ?> <button class="btn">เพิ่ม quotation</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_quotation/delete")) { ?> <button class="btn">ลบ quotation</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_quotation/edit")) { ?> <button class="btn">แก้ไข quotation</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_quotation/approve")) { ?> <button class="btn">อนุมัติ quotation</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_quotation/revise")) { ?> <button class="btn">revise quotation</button><?php } ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body tool-btn">
                <h4>bill</h4>
                <?php if (get_permitPath("bill/ctl_bill")) { ?> <button class="btn">ดู bill</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_bill/insert")) { ?> <button class="btn">เพิ่ม bill</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_bill/delete")) { ?> <button class="btn">ลบ bill</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_bill/edit")) { ?> <button class="btn">แก้ไข bill</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_bill/approve")) { ?> <button class="btn">อนุมัติ bill</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_bill/revise")) { ?> <button class="btn">revise bill</button><?php } ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body tool-btn">
                <h4>workorder</h4>
                <?php if (get_permitPath("bill/ctl_workorder/")) { ?> <button class="btn truncate">ดู workorder</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_workorder/insert")) { ?> <button class="btn">เพิ่ม workorder</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_workorder/delete")) { ?> <button class="btn">ลบ workorder</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_workorder/edit")) { ?> <button class="btn">แก้ไข workorder</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_workorder/approve")) { ?> <button class="btn">อนุมัติ workorder</button><?php } ?>
                <?php if (get_permitPath("bill/ctl_workorder/revise")) { ?> <button class="btn">revise workorder</button><?php } ?>
            </div>
        </div>

    </div>

</div>