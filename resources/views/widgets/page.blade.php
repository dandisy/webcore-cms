@if(count($widgetContent) > 0)
    @include('layouts.position.top')

    @include('layouts.position.left')
                    
    <div class="main-content">
        <pre>
            {{ print_r(@$widgetContent['main']) }}
        </pre>
    </div>

    @include('layouts.position.right')

    @include('layouts.position.bottom')
@else
    <div class="main-content no-content">
        <div class="panel">
            <div class="panel-body">
                <h2>Tidak ada sumber data!</h2>
                <p>Buat dan tulis data pada sumber data untuk halaman ini.</p>
            </div>
        </div>
    </div>
@endif