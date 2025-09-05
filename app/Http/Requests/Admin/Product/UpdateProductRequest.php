<?php

	namespace App\Http\Requests\Admin\Product;

	use Illuminate\Foundation\Http\FormRequest;

	class UpdateProductRequest extends FormRequest
	{
		/**
		 * Determine if the user is authorized to make this request.
		 */
		public function authorize(): bool
		{
			return true;
		}

		/**
		 * Get the validation rules that apply to the request.
		 *
		 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
		 */
		public function rules(): array
		{
			return [
				'name' => 'required|string|max:255',
				'description' => 'nullable|string',
				'price' => 'required|numeric|min:0',
				'category' => 'required|string|max:255',
				'image' => 'nullable|image|max:2048',
				'is_active' => 'nullable|boolean',
				'discount' => 'nullable|numeric|min:0|max:100',
			];
		}
	}