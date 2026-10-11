<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class Customers extends BaseController
{
    public function index(): string
    {
        $customerModel = new CustomerModel();
        $customers = $customerModel->findAll();

        return view('customers/index', ['customers' => $customers]);
    }

    public function new(): string
    {
        return view('customers/form', [
            'title'    => 'New Customer',
            'customer' => null,
        ]);
    }

    public function create(): RedirectResponse
    {
        $data = $this->customerData();

        if (! $this->validateData($data, $this->customerRules())) {
            return redirect()->to(site_url('customers/new'))->withInput()->with('errors', $this->validator->getErrors());
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        (new CustomerModel())->insert($data);

        return redirect()->to(site_url('customers'))->with('success', 'Customer account created.');
    }

    public function edit(int $id): string
    {
        return view('customers/form', [
            'title'    => 'Edit Customer',
            'customer' => $this->findCustomer($id),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->findCustomer($id);
        $data = $this->customerData();

        if (! $this->validateData($data, $this->customerRules())) {
            return redirect()->to(site_url('customers/' . $id . '/edit'))->withInput()->with('errors', $this->validator->getErrors());
        }

        (new CustomerModel())->update($id, $data);

        return redirect()->to(site_url('customers'))->with('success', 'Customer account updated.');
    }

    /** @return array{full_name: string, email: string, phone: string} */
    private function customerData(): array
    {
        return [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];
    }

    /** @return array<string, array{label: string, rules: list<string>}> */
    private function customerRules(): array
    {
        return [
            'full_name' => [
                'label' => 'Full name',
                'rules' => ['required', 'max_length[100]'],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => ['required', 'valid_email', 'max_length[100]'],
            ],
            'phone' => [
                'label' => 'Phone',
                'rules' => ['permit_empty', 'max_length[20]'],
            ],
        ];
    }

    /** @return array<string, mixed> */
    private function findCustomer(int $id): array
    {
        $customer = (new CustomerModel())->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound('Customer not found.');
        }

        return $customer;
    }
}
