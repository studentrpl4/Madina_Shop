<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\OrderService;
use Livewire\Component;

class OrderForm extends Component
{

    public Product $product;
    public $orderData;
    public $subTotalAmount;
    public $quantity = 1;
    public $name;
    public $email;

    protected $orderService;

    public function boot(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function mount(Product $product, $orderData)
    {
        $this->product = $product;
        $this->orderData = $orderData;
        $this->subTotalAmount = $product->price;
    }

    public function updatedQuantity()
    {
        $this->validateOnly('quantity', [
            'quantity' => 'required|integer|min:1|max:'. $this->product->stock,
        ],
        [
            'quantity.max' => 'Stok Tidak Tersedia',
        ]);
        $this->calculateTotal();
    }

    public function calculateTotal(): void
    {
        $this->subTotalAmount = $this->product->price * $this->quantity;
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock)  {
            $this->quantity++;
            $this->calculateTotal();
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->calculateTotal();
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1|max:' . $this->product->stock,
        ];
    }

    protected function gatherBookingData(array $validatedData): array
    {
        return [
            'name'=> $validatedData['name'],
            'email' => $validatedData['email'],
            'sub_total_amount' => $this->subTotalAmount,
            'quantity' => $this->quantity,
        ];
    }

    public function submit()
    {
        $validatedData = $this->validate();
        $bookingData = $this->gatherBookingData($validatedData);
        $this->orderService->updateCustomerData($bookingData);
        return redirect()->route('front.customer_data');
    }

    public function render()
    {
        return view('livewire.order-form');
    }
}
