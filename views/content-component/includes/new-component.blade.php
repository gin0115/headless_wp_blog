<div class="compoent new-{{ $position }}">
@select(class="new-component $position" value=$selection values=$components alias=$component)
    @items( id="chkx" value=$component->get_title() text=$component->get_title())
@endselect
@button(type="button" value="new" text="New Component" id="new_componet_$position")
</div>