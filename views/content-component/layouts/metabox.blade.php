<div id="content-compoent">
    @include('content-component.includes.header')
    <div id="compoents">
        @include('content-component.includes.new-component', ['components' => $components, 'position' => 'top'])
        <div class="component-selection">
        <div id="block1" class="component component-header component-draggable">

            block 1
            @input(type="hidden" name="related_pages[]" value="block1")
        </div>

        <div id="block2" class="component component-header component-draggable">

            block 2
            @input(type="hidden" name="related_pages[]" value="block2")
        </div><div class="droppable-helper"></div>
        </div>
        
        @include('content-component.includes.new-component', ['components' => $components, 'position' => 'bottom'])
    </div>
    @include('content-component.includes.footer')
</div>
