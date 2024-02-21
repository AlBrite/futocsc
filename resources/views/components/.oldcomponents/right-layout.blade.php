                @php
                if (empty($scripts) or !is_array($scripts)) {
                    $scripts = [];
                }
                @endphp
                <div class="container-right border radius gap-1">
                    {{$slot}}
                </div>
            </div>
        </section>
    </main>

    <script src="{{asset('js/main.js')}}"></script>
    @foreach($scripts as $script)
            <script src="{{asset($script)}}"></script>
        @endforeach
    </body>
</html>