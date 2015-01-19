<?php

$plugin_info = array(
  'pi_name' => 'fixed_next_prev',
  'pi_version' =>'1.0',
  'pi_author' =>'Nathan Pitman',
  'pi_author_url' => 'http://www.ninefour.co.uk/labs',
  'pi_description' => '',
  'pi_usage' => '{exp:fixed_next_prev entry_id="current_entry_id" fixed_order="entry_ids_to_navigate"}',
  );

class fixed_next_prev {

    public $return_data;

    public function __construct()
    {

        $variables['next_entry_id'] = FALSE;
        $variables['prev_entry_id'] = FALSE;
        $variables['next_entry_title'] = NULL;
        $variables['prev_entry_title'] = NULL;
        $variables['next_entry_url_title'] = NULL;
        $variables['prev_entry_url_title'] = NULL;

        $entry_id = ee()->TMPL->fetch_param('entry_id', NULL);
        $fixed_order = ee()->TMPL->fetch_param('fixed_order', NULL);

        $entry_ids = explode('|', $fixed_order);

        $index = array_search($entry_id, $entry_ids);

        if($index !== FALSE)
        {
            if (isset($entry_ids[$index + 1])) {
                $variables['next_entry_id'] = $entry_ids[$index + 1];

                ee()->db->select('title, url_title');
                ee()->db->where('entry_id', $variables['next_entry_id']);
                $next_entry_object = ee()->db->get('channel_titles');
                $next_entry = $next_entry_object->row_array();

                if ($next_entry) {
                    $variables['next_entry_title'] = $next_entry['title'];
                    $variables['next_entry_url_title'] = $next_entry['url_title'];
                }
            }
            if (isset($entry_ids[$index - 1])) {
                $variables['prev_entry_id'] = $entry_ids[$index - 1];

                ee()->db->select('title, url_title');
                ee()->db->where('entry_id', $variables['prev_entry_id']);
                $prev_entry_object = ee()->db->get('channel_titles');
                $prev_entry = $prev_entry_object->row_array();

                if ($prev_entry) {
                    $variables['prev_entry_title'] = $prev_entry['title'];
                    $variables['prev_entry_url_title'] = $prev_entry['url_title'];
                }
            }
        }

        $this->return_data = ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $variables);

        return $this->return_data;

    }

}
