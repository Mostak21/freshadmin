@extends('backend.layouts.app')

@section('content')
<div class="rit-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Product wise stock report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <!--card body-->
            <div class="card-body">
                <form action="{{ route('stock_report.index') }}" method="GET">
                    <div class="form-group row offset-lg-2">
                        <label class="col-md-3 col-form-label">{{translate('Sort by Category')}} :</label>
                        <div class="col-md-5">
                            <select id="demo-ease" class="from-control rit-selectpicker" name="category_id" required>
                                @foreach (\App\Models\Category::all() as $key => $category)
                                    <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered rit-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Product Name') }}</th>
                            <th>{{ translate('Stock') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            @php
                                $qty = 0;
                                foreach ($product->stocks as $key => $stock) {
                                    $qty += $stock->qty;
                                }
                            @endphp
                            <tr>
                                <td>{{ $product->getTranslation('name') }}</td>
                                <td>{{ $qty }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="rit-pagination mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
