<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(TimeProjectSeed::class);
        $this->call(ClientContactSeed::class);
        $this->call(CurrencySeed::class);
        $this->call(DepartmentSeed::class);
        $this->call(EmployeeSeed::class);
        $this->call(EmergencyContactSeed::class);
        $this->call(TruckAttachmentStatusSeed::class);
        $this->call(MachinerySizeSeed::class);
        $this->call(MachineryTypeSeed::class);
        $this->call(OperationTypeSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(RouteSeed::class);
        $this->call(TimeWorkTypeSeed::class);
        $this->call(TrailerSeed::class);
        $this->call(UnitMeasurementSeed::class);
        $this->call(UserSeed::class);
        $this->call(UserActionSeed::class);
        $this->call(VehicleSeed::class);
        $this->call(VendorSeed::class);
        $this->call(VendorContactSeed::class);
        $this->call(EmployeeSeedPivot::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);

    }
}
