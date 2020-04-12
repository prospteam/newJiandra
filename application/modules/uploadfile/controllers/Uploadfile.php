<?php

class Uploadfile extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		if ($this->_hasUsers == false) {
			show_404();
		}
	}

	public function index()
	{
		$data['notify'] = '';

		$config['upload_path'] = './files/';
		$config['allowed_types'] = 'text/plain|text/csv|csv';
		$this->load->library('upload', $config);

		if ($_POST) {
			if (!$this->upload->do_upload()) {
				$a_data['notify'] =  '<div class="notifyContent" style="background:red">' . $this->upload->display_errors() . '</div>';
			} else {
				// upload file
				$file_data = $this->upload->data();

				$readUploadedCSV = $this->readcsvdata($file_data['file_name']);
				cute_print($readUploadedCSV);

				// delete uploaded file
				unlink($file_data['full_path']);
			}
		}

		if (!IS_AJAX) {
			$data['content'] = 'uploadfile/index';
			$this->main_template($data);
		}
	}


	function readcsvdata($filename)
	{
		$handle = fopen("./files/" . $filename, "r");
		$retdata = array();
		while (!feof($handle)) {
			$retdata[] = fgetcsv($handle, 1024, ",");
		}
		fclose($handle);

		if (!empty($retdata)) {
			$csvData = array();

			if (!empty($retdata)) {
				foreach ($retdata as $key => $val) {
					if ($key == 0 || !is_array($val)) continue;
					$newData = array();

					foreach ($val as $k => $v) {
						$newData[$retdata[0][$k]] = $v;
					}

					$csvData[] = $newData;
				}
			}

			$retdata = $csvData;
		}

		return $retdata;
	}
}
