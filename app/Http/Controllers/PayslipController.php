<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payslip;
use Illuminate\Http\Request;
use App\Services\PayslipGeneratorService;

class PayslipController extends Controller
{
    protected $payslipService;

    public function __construct(PayslipGeneratorService $payslipService)
    {
        $this->payslipService = $payslipService;
    }

    // Show form to generate a payslip
    public function create()
    {
        $employees = Employee::all();
        return view('payslips.create', compact('employees'));
    }

    // Handle form submission and generate payslip
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
        ]);

        $result = $this->payslipService->generatePayslip(
            $request->employee_id,
            $request->month,
            $request->year
        );

        if (isset($result['status']) && $result['status'] === 'error') {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->route('payslips.index')->with('success', 'Payslip generated successfully!');
    }

    // Show all payslips (optional)
    public function index()
    {
        $payslips = Payslip::with('employee')->latest()->get();
        return view('payslips.index', compact('payslips'));
    }

        /**
     * Display the specified resource.
     */
        public function showPayslip(Payslip $payslip)
        {

            //eager load
            $payslip->load('employee');
            //dd($payslip);
            return view('payslips.show', compact('payslip'));
        }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payslip $payslip)
    {
        $payslip->delete();
        return to_route('payslips.index')->with('success','Payslip deleted successfully');
    }
}
