    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="d-flex justify-content-between my-2">
                        <h6>Product Variant</h6>
                        <a href="{{ route('admin.product.variant.create', $product->id) }}"
                            class="btn btn-secondary btn-sm " id="btnAddVariant">
                            <i class="fas fa-plus"></i> Add
                        </a>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <td scope="col">#</td>
                                <td scope="col">Name</td>
                                <td scope="col">Price</td>
                                <td scope="col">Stock</td>
                                <td scope="col">Weight</td>
                                <td scope="col"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($product->variants as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->price }}
                                    </td>
                                    <td>
                                        {{ $item->stock }}
                                    </td>
                                    <td>
                                        {{ $item->weight }}
                                    </td>
                                    <td align="center">
                                        <div class="dropdown" style="z-index: 9999">
                                            <button class="btn btn-secondary btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('admin.product.variant.edit', $item->id) }}"
                                                        class="dropdown-item" href="#">Edit</a></li>
                                                <li>
                                                    <form
                                                        action="{{ route('admin.product.variant.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            href="#">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Product tidak memiliki variant</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
