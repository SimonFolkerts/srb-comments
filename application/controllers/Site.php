<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Video');
        $this->load->model('Comment');
    }

    function index($video_id = null, $comment_id = null) {
        if (isset($video_id)) {
            //get a video
            $query = $this->db->query('SELECT * FROM videos WHERE id = ?', array($video_id));
            $data['video'] = $query->custom_row_object(0, 'Video');

            //get all comments for selected video
            $query = $this->db->query('SELECT * FROM comments WHERE comments.video_id = ?', array($video_id));
            $data['comments'] = $query->custom_result_object('Comment');

            if ($this->input->post()) {
                if (isset($comment_id)) {
                    $comment['comment'] = $this->input->post('comment');
                    $this->db->where('id', $comment_id);
                    $this->db->update('comments', $comment);
                } else {
                    $comment['comment'] = $this->input->post('comment');
                    $comment['video_id'] = $video_id;
                    $this->db->insert('comments', $comment);
                }
                redirect('site/index/' . $video_id);
            }
            if (isset($comment_id)) {
                $query = $this->db->query('SELECT * FROM comments WHERE id = ?', array($comment_id));
                $data['editComment'] = $query->row()->comment;
            }

            //load view
            $this->loadView('video', $data);
        } else {
            //get all videos
            $query = $this->db->query("SELECT * FROM videos");
            $data['contents'] = $query->custom_result_object('Video');
            //load view
            $this->loadView('site', $data);
        }
    }

    public function edit($video_id, $comment_id = null) {

        $data['comment_id'] = $comment_id;
        if (isset($comment_id)) {
            //if editing comment
            $data['comment_id'] = $comment_id;
            $comment['comment'] = $this->input->post('comment');
            $this->db->where('id', $comment_id);
            $this->db->update('comments', $comment);
            redirect('site/index/' . $video_id);
        }
    }

    public function deleteComment($comment_id, $video_id) {
        $query = $this->db->query('DELETE FROM comments WHERE id = ?', array($comment_id));
        redirect('site/index/' . $video_id);
    }

    private function loadView($view, $data) {
        $this->load->view('header');
        $this->load->view('css');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }

}
