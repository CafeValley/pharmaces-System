<?php
function usertypeselect($usertype = null)
{ ?>
    <select name="usertype" class="form-control">
        <?php
        switch ($usertype) {
            case '':
                echo "<option selected value=''>User type</option>";
                echo "<option value='Pharmacist'>Pharmacist</option>";
                echo "<option value='Pharmacy Assistant'>Pharmacy Assistant</option>";
                echo "<option value='Accountant'>Accountant</option>";
                echo "<option value='Pharmacy technician'>Pharmacy technician</option>";
                echo "<option value='Admin'>Admin</option>";
                break;
            case 'Pharmacist':
                echo "<option value=''>User type</option>";
                echo "<option selected value='Pharmacist'>Pharmacist</option>";
                echo "<option value='Pharmacy Assistant'>Pharmacy Assistant</option>";
                echo "<option value='Accountant'>Accountant</option>";
                echo "<option value='Pharmacy technician'>Pharmacy technician</option>";
                echo "<option value='Admin'>Admin</option>";
                break;
            case 'Pharmacy Assistant':
                echo "<option value=''>User type</option>";
                echo "<option value='Pharmacist'>Pharmacist</option>";
                echo "<option selected value='Pharmacy Assistant'>Pharmacy Assistant</option>";
                echo "<option value='Accountant'>Accountant</option>";
                echo "<option value='Pharmacy technician'>Pharmacy technician</option>";
                echo "<option value='Admin'>Admin</option>";
                break;
            case 'Accountant':
                echo "<option value=''>User type</option>";
                echo "<option value='Pharmacist'>Pharmacist</option>";
                echo "<option value='Pharmacy Assistant'>Pharmacy Assistant</option>";
                echo "<option selected value='Accountant'>Accountant</option>";
                echo "<option value='Pharmacy technician'>Pharmacy technician</option>";
                echo "<option value='Admin'>Admin</option>";
                break;
            case 'Pharmacy technician':
                echo "<option value=''>User type</option>";
                echo "<option value='Pharmacist'>Pharmacist</option>";
                echo "<option value='Pharmacy Assistant'>Pharmacy Assistant</option>";
                echo "<option value='Accountant'>Accountant</option>";
                echo "<option selected value='Pharmacy technician'>Pharmacy technician</option>";
                echo "<option value='Admin'>Admin</option>";
                break;
            case 'Admin':
                echo "<option value=''>User type</option>";
                echo "<option value='Pharmacist'>Pharmacist</option>";
                echo "<option value='Pharmacy Assistant'>Pharmacy Assistant</option>";
                echo "<option value='Accountant'>Accountant</option>";
                echo "<option value='Pharmacy technician'>Pharmacy technician</option>";
                echo "<option selected value='Admin'>Admin</option>";
                break;
            default:
                echo "<option value=''>User type</option>";
                echo "<option value='Pharmacist'>Pharmacist</option>";
                echo "<option value='Pharmacy Assistant'>Pharmacy Assistant</option>";
                echo "<option value='Accountant'>Accountant</option>";
                echo "<option value='Pharmacy technician'>Pharmacy technician</option>";
                echo "<option value='Admin'>Admin</option>";
        }
        ?>
    </select>
<?php
}
function accountsourceselect($source = null)
{ ?>
    <select name="accountsource" class="form-control">
        <?php
        switch ($source) {
            case '':
                echo "<option value=''>select account source</option>";
                echo "<option value='Expenses'>Expenses</option>";
                echo "<option value='payroll'>payroll</option>";
                echo "<option value='loans'>loans</option>";
                echo "<option value='safe'>safe</option>";
                break;
            case 'Expenses':
                echo "<option value=''>select account source</option>";
                echo "<option selected value='Expenses'>Expenses</option>";
                echo "<option value='payroll'>payroll</option>";
                echo "<option value='loans'>loans</option>";
                echo "<option value='safe'>safe</option>";
                break;
            case 'payroll':
                echo "<option value=''>select account source</option>";
                echo "<option value='Expenses'>Expenses</option>";
                echo "<option selected value='payroll'>payroll</option>";
                echo "<option value='loans'>loans</option>";
                echo "<option value='safe'>safe</option>";
                break;
            case 'loans':
                echo "<option value=''>select account source</option>";
                echo "<option value='Expenses'>Expenses</option>";
                echo "<option value='payroll'>payroll</option>";
                echo "<option selected value='loans'>loans</option>";
                echo "<option value='safe'>safe</option>";
                break;
            case 'safe':
                echo "<option value=''>select account source</option>";
                echo "<option value='Expenses'>Expenses</option>";
                echo "<option value='payroll'>payroll</option>";
                echo "<option value='loans'>loans</option>";
                echo "<option selected value='safe'>safe</option>";
                break;
            default:
                echo "<option selected value=''>select account source</option>";
                echo "<option value='Expenses'>Expenses</option>";
                echo "<option value='payroll'>payroll</option>";
                echo "<option value='loans'>loans</option>";
                echo "<option value='safe'>safe</option>";
        }
        ?>

    </select>
<?php
}
function paymenttypeselect($paymenttype = null)
{ ?>
    <select name="paymenttype" class="form-control">
        <?php
        switch ($paymenttype) {
            case '':
                echo "<option value = ''>payment type</option>";
                echo "<option value = 'cash'>cash</option>";
                echo "<option value = 'bank'>bank</option>";
                break;
            case 'cash':
                echo "<option value = ''>payment type</option>";
                echo "<option selected value = 'cash'>cash</option>";
                echo "<option value = 'bank'>bank</option>";
                break;
            case 'bank':
                echo "<option value = ''>payment type</option>";
                echo "<option value = 'cash'>cash</option>";
                echo "<option selected value = 'bank'>bank</option>";
                break;
            default:
                echo "<option selected value = ''>payment type</option>";
                echo "<option value = 'cash'>cash</option>";
                echo "<option value = 'bank'>bank</option>";
        }
        ?>

    </select>
<?php
}
function Movementradio($movement = null)
{ ?>

    <div class="form-group">
        <label>Movement</label>
        <div class="radio">
            <label>
                <?php if ($movement == "withdrawal")
                    echo "<input checked name='movement' type='radio' value='withdrawal'>";
                else
                    echo "<input name='movement' type='radio' value='withdrawal'>";
                ?>

                Withdrawal
            </label>
        </div>
        <div class="radio">
            <label>
                <?php if ($movement == "deposit")
                    echo "<input checked name='movement' type='radio' value='deposit'>";
                else
                    echo "<input name='movement' type='radio' value='deposit'>";
                ?>
                deposit
            </label>
        </div>

    </div>
<?php
}
?>