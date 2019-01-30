<?php

namespace App\Cms\Controllers\Classes;

use URL, Auth;
use App\Cms\{Models\Page};

class TreeMaker
{
      public $url;
      public $categories;
      public $spec_categories;
      public $mode = null;

      public function __construct(\Kalnoy\Nestedset\Collection $categories = null)
      {
          $this->categories = $categories;
      }

      public function from($categories)
      {
          $this->spec_categories = $categories;
          return $this;
      }

      public function mode(String $mode = null)
      {
          $this->mode = $mode;
          return $this;
      }

      public function currentUrl($url = null)
      {
          $this->url = $url;
          return $this;
      }

      public function get($type = 'ul')
      {
          $func = method_exists($this, 'tree'.ucfirst($type).'Container') ? 'tree'.ucfirst($type).'Container' : 'noContainer';

          try {
              $data = isset($this->spec_categories) ? $this->$func($this->spec_categories) : $this->$func($this->categories);
          } catch (Exception $e) {
              echo 'Exception: ',  $e->getMessage(), "\n";
          }
          unset($this->spec_categories);
          return $data;
      }

      public function treeSelectContainer($categories, Array $selectTree = null)
      {
          foreach ($categories as $category) {
              $selectTree[$category->id] = str_pad($category->getTranslate()->name, strlen($category->getTranslate()->name)+$category->depth*3, '-- ', STR_PAD_LEFT);
              $selectTree = $this->treeSelectContainer($category->children, $selectTree);
          }

          return $selectTree;
      }

      public function treeStructureContainer($categories = null, String $ulTree = null)
      {
          $ulTree .= $ulTree == null ? '<ol class="sitemap cms-menu">' : '<ol>';
          foreach($categories as $category){
            $unsortable = $category->id == 1 ? ' data-drag="false"' : ' data-drag="true"' ;
            $active = $category->url == $this->url ? ' class="active"' : '';

            $ulTree .= '<li'.$active.$unsortable.' data-id="'.$category->id.'">';
              $ulTree .= '<div class="structure-toggle float-right">';
                $ulTree .= '<!-- <a href="'.URL::to(env('CMS_URL', 'panel')).'/create"><i class="fas fa-plus-circle"></i></a> -->';
                if($category->id > 1)$ulTree .= '<a href="javascript:deletePageOpen('.$category->id.')"><i class="fas fa-trash"></i></a>';
              $ulTree .= '</div>';
              $ulTree .= '<a href="'.URL::to(env('CMS_URL', 'panel')).'/'.($category->module == null ? 'pages/'.$category->url : 'modules/'.$category->module.'/'.$category->url).'">';
              $ulTree .= count($category->children) == null ? '<i class="fas fa-file ml-2"></i>' : '<i class="fas fa-folder ml-2"></i>';
              $ulTree .= '</a>';
              $ulTree .= '<span>'.$category->getTranslate()->name.'</span>';
              $ulTree = count($category->children) > 0 ? $this->treeStructureContainer($category->children, $ulTree) : $ulTree.'<ol></ol>';
            $ulTree .= '</li>';
          }
          $ulTree .= '</ol>';

          return Auth::user()->first() != null ? $ulTree : false;
      }

      public function treeSitemapContainer($categories = null, String $ulTree = null)
      {
          $ulTree .= $ulTree == null ? '<ul class="sitemap">' : '<ul>';
          foreach($categories as $category){
            $active = $category->url == $this->url ? ' class="active"' : '';
            $fullUrl = $category->id != 1 ? $this->from($category)->get('fullUrl') : '/';
            $ulTree .= '<li'.$active.'>';
              $ulTree .= '<a href="'.URL::to($fullUrl).'">'.$category->getTranslate()->name.'</a>';
              $ulTree = count($category->children) > 0 && $this->mode != 'simple' ? $this->treeSitemapContainer($category->children, $ulTree) : $ulTree;
            $ulTree .= '</li>';
          }
          $ulTree .= '</ul>';

          return $ulTree;
      }

      public function treeFullUrlContainer(\App\Cms\Models\Page $category = null)
      {
          $fullUrl = null;$newArray = [];
          foreach($category->ancestors->pluck('url')->toArray() as $url)if($url != '/')$newArray[] = $url;
          $fullUrl .= implode('/', $newArray);
          $fullUrl .= '/'.$category->url;

          return $fullUrl;
      }

      public function treeBreadcrumbsContainer(\App\Cms\Models\Page $category = null)
      {
          $fullUrl = null;$newArray = [];
          foreach($category->ancestors->pluck('url')->toArray() as $url)if($url != '/')$newArray[] = $url;
          $fullUrl .= implode('/', $newArray);
          $fullUrl .= '/'.$category->url;

          return $fullUrl;
      }

      public function noContainer($categories = null)
      {
          return 'noData';
      }
}
