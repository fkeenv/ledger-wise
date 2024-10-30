<?php

namespace App\Repositories\HRIS;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tenants\HRIS\Salary;
use App\Models\Tenants\HRIS\Employee;

class EmployeeSalaryRepository
{
    public function get(Employee $employee)
    {
        return $employee->salaries;
    }

    // Employee Salary
    public function create(Request $request, Employee $employee): Salary
    {
        $data = $this->getData($request, $employee);

        return $employee->salaries()->create([
            'tax_amount'         => $data['tax'],
            'gross_salary'       => $data['grossSalary'],
            'net_salary'         => $data['netSalary'],
            'salary_rate'        => $data['salaryRate'],
            'total_days_worked'  => $data['totalDaysWorked'],
            'total_minutes_late' => 0, // TO DO: Implement this
            'cut_off_start'      => $this->getCutOffDates($request)['start'],
            'cut_off_end'        => $this->getCutOffDates($request)['end'],
            'date_generated'     => now(),
            'benefits'           => $data['benefits'],
        ]);
    }

    public function show(Employee $employee, Salary $salary)
    {
        return $employee->salaries()->findOrFail($salary->id);
    }

    public function update(Request $request, Employee $employee, Salary $salary)
    {
        // WARNING: This should only be used by one person (preferable the top management)
        return tap($salary)->update([
            'amount'             => $request->amount,
            'net_salary'         => $request->net_salary,
            'tax_amount'         => $request->tax_amount,
            'gross_salary'       => $request->gross_salary,
            'total_days_worked'  => $request->total_days_worked,
            'total_minutes_late' => $request->total_minutes_late,
            'cut_off_start'      => $request->cut_off_start,
            'cut_off_end'        => $request->cut_off_end,
            'date_generated'     => $request->date_generated,
            'benefits'           => $request->benefits,
        ]);
    }

    public function destroy(Employee $employee, Salary $salary)
    {
        return $employee->salaries()->findOrFail($salary->id)->delete();
    }

    private function getCutOffDates(Request $request): array
    {
        $cutOffStart = $request->has('cut_off')
            ? Carbon::parse($request->cut_off)
            : (now()->copy()->day <= 10 ? now()->copy()->subMonth()->day(26) : now()->copy()->day(11));
        $cutOffEnd = $request->has('cut_off')
            ? Carbon::parse($request->cut_off)->addDays(14)
            : (now()->copy()->day <= 10 ? now()->copy()->day(10) : now()->copy()->day(25));

        return [
            'start' => $cutOffStart,
            'end' => $cutOffEnd,
        ];
    }

    private function getAttendances(Request $request, Employee $employee)
    {
        return $employee->attendances()->whereBetween('date', $this->getCutOffDates($request))->get();
    }

    // TO DO: Implement this
    private function getTotalMinutesLate(Request $request, Employee $employee)
    {
        return $employee->attendances()->whereBetween('date', $this->getCutOffDates($request))->sum('minutes_late');
    }

    private function getSalaryRate(Employee $employee)
    {
        if ($employee->setting->salary_type === 'daily') {
            return $employee->setting->salary;
        } elseif ($employee->setting->salary_type === 'monthly') {
            return $employee->setting->salary / 30;
        } elseif ($employee->setting->salary_type === 'semi-monthly') {
            return $employee->setting->salary / 15;
        } elseif ($employee->setting->salary_type === 'weekly') {
            return $employee->setting->salary / 7;
        } elseif ($employee->setting->salary_type === 'hourly') {
            return $employee->setting->salary * 8;
        }

        return 0;
    }

    private function getData(Request $request, Employee $employee)
    {
        $tax = $employee->setting->tax;
        $salaryRate = $this->getSalaryRate($employee);
        $benefits = [];

        $totalDaysWorked = $this->getAttendances($request, $employee)->count();
        $grossSalary = $salaryRate * $totalDaysWorked;

        // Get all the benefits of the employee
        if ($employee->benefits->count()) {
            $employee->benefits()->each(function ($benefit) use (&$grossSalary, &$benefits) {
                $employerShare = $benefit->pivot->employer_weight / 100;
                $amount = $employerShare * $grossSalary;
                $benefits[] = [
                    'name'   => $benefit->name,
                    'amount' => $amount,
                ];
            });
        }

        // Apply Tax
        $taxAmount = $grossSalary * ($tax);
        $netSalary = $grossSalary - $taxAmount;

        // If the employee has benefits, deduct the amount from the net salary
        if (collect($benefits)->isNotEmpty()) {
            collect($benefits)->each(function ($benefit) use (&$netSalary) {
                $netSalary -= $benefit['amount'];
            });
        }

        return [
            'tax'             => $tax,
            'grossSalary'     => $grossSalary,
            'netSalary'       => $netSalary,
            'salaryRate'      => $salaryRate,
            'totalDaysWorked' => $totalDaysWorked,
            'benefits'        => $benefits,
        ];
    }
}
