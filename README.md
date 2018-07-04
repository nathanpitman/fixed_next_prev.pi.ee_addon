# Fixed Next/Prev for ExpressionEngine

This simple plug-in takes a 'current' entry_id and a pipe delimited list of entry IDs and returns the next or previous entry ID, as well as the current count and total entries.

```
<ul>
{exp:fixed_next_prev entry_id="{segment_3}" fixed_order="{get:entry_ids}"}
    {if next_entry_id}<li><a href="{path='content/entry'}/{next_entry_id}/{next_entry_url_title}?entry_ids={get:entry_ids}">Next... {next_entry_title}</a></li>{/if}
    <li>{entry_current_count} of {total_entries_count}</li>
    {if prev_entry_id}<li><a href="{path='content/entry'}/{prev_entry_id}/{prev_entry_url_title}?entry_ids={get:entry_ids}">Prev... {prev_entry_title}</a></li>{/if}
{/exp:fixed_next_prev}
</ul>
```
