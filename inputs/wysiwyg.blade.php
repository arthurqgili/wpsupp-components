@props(['options' => []])

<style>
    .ql-editor {
        box-shared.sizing: initial;
        line-height: initial;
        height: initial;
        outline: initial;
        overflow-y: initial;
        padding: initial;
        -o-tab-size: initial;
        tab-size: initial;
        -moz-tab-size: initial;
        text-align: initial;
        white-space: initial;
        word-wrap: initial;
    }

    #editor-toolbar {
        display: flex;
        column-gap: 8px;
    }

    #editor-toolbar svg {
        display: none !important;
    }

    #editor-toolbar button {
        padding: 0;
        height: 16px;
        width: 16px;
        line-height: 16px;
    }

    #editor-toolbar button::before {
        font-family: 'Material Symbols Outlined';
        font-size: 20px;
        color: #C6C6C5;
    }

    #editor-toolbar button.ql-active::before {
        color: #0166FF !Important;
    }

    #editor-toolbar .ql-bold::before {
        content: 'format_bold';
    }

    #editor-toolbar .ql-list::before {
        content: 'format_list_bulleted';
    }

    #editor-toolbar .ql-attach::before {
        content: 'attach_file';
    }

    #editor-toolbar .ql-indent::before {
        content: 'format_indent_increase';
    }

    #editor-toolbar .ql-indent.decrease::before {
        content: 'format_indent_decrease';
    }
</style>
<div x-data="editorSetup()" x-shared.init="initEditor"
    class="overflow-hidden border border-white rounded-sm editor focus-within:border-blue-1">
    <div id="editor-toolbar" class="!border-0 p-xxs bg-black-3">
        @foreach ($options as $option)
            @if ($option === 'bold')
                <button class="ql-bold"></button>
            @elseif ($option === 'list')
                <button class="ql-list" value="bullet"></button>
            @elseif ($option === 'attach')
                <button class="ql-attach"></button>
            @elseif ($option === 'indent')
                <button class="ql-indent" value="+1"></button>
                <button class="ql-indent decrease" value="-1"></button>
            @endif
        @endforeach
    </div>
    <div id="editor-container"
        class="!border-0 p-sm !font-raleway font-[400] text-[12px] text-white overflow-y-auto max-h-xxxl"></div>
</div>
@if ($option === 'attach')
    @push('scripts')
        <script>
            document.addEventListener('quill:loaded', function(event) {
                const quill = event.detail.quill;
                const attachButton = document.querySelector('.ql-attach');
                if (attachButton) {
                    attachButton.addEventListener('click', function() {
                        const input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.click();

                        input.onchange = () => {
                            const file = input.files[0];
                        };
                    });
                }
            });
        </script>
    @endpush
@endif
