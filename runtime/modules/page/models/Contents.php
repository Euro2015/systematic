<?php

/**
 * This is the model class for table "tbl_contents".
 *
 * The followings are the available columns in table 'tbl_contents':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property integer $parent
 * @property string $meta_title
 * @property string $meta_desc
 * @property string $meta_keywords
 * @property string $page_seo
 * @property integer $status
 * @property integer $display_order
 * @property integer $display_form
 */
class Contents extends CActiveRecord
{
    public $maxOrder;//atttribute to hold the maximum content display order
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{contents}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, desc', 'required'),
			array('parent, status, display_order, display_form', 'numerical', 'integerOnly'=>true),
			array('title, meta_title, meta_desc, meta_keywords,page_seo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, desc, parent, meta_title, meta_desc, meta_keywords, page_seo, status, display_order, google_map, display_map, display_form', 'safe', 'on'=>'search'),
            array('google_map, display_map, display_form,created_date', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Page Title',
			'desc' => 'Page Content',
			'parent' => 'Parent',
			'meta_title' => 'Title',
			'meta_desc' => 'Description',
			'meta_keywords' => 'Keywords',
			'page_seo' => 'Page Seo',
			'status' => 'Visibility',
			'display_order' => 'Display Order',
            'google_map'=>'Google Map', 
            'display_map' => 'Display Map',
			'display_form' => 'Display Form',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('page_seo',$this->page_seo,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('display_order',$this->display_order);
        $criteria->compare('google_map',$this->display_order);
        $criteria->compare('display_map',$this->display_order);
		$criteria->compare('display_form',$this->display_form);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function listParent()
    {
        return self::model()->findAllByAttributes(array('parent'=>'0'));
    }

    public function listPage()
    {
        $criteria=new CDbCriteria;
        $criteria->condition='parent = 0';
        $criteria->order = 'id asc';
        return self::model()->findAll($criteria);
    }
    
    public function getMaxDisplayOrder($parent)
    {
        $criteria=new CDbCriteria;
        $criteria->select='max(display_order) AS maxOrder';
        $criteria->condition='parent = :parentId';
        $criteria->params=array(':parentId'=>$parent);
        $row = $this->find($criteria);
        
        $displayOrder = $row['maxOrder'];
        return $displayOrder;   
    }
    public function getTitleById($id)
    {
    	return self::model()->findByPk($id)->title;
    }
    
    public function getBySlug($slug)
    {
        $criteria=new CDbCriteria;
        $criteria->condition = 'page_seo = :slugName';
        $criteria->params = array(':slugName'=>$slug);
        return self::model()->find($criteria); 
    }


	public function displayChildPages($parentId)
    {
            $pages = Contents::model()->findAll(array(
                'select'=>'title,page_seo',
                'condition'=>'parent="'.$parentId.'" AND status=1',
                'order'=>'display_order ASC',
            ));
            return $pages;
    }
    
    public function displaySubPages($parentSlug)
    {
        $parentModel = Contents::getBySlug($parentSlug);
        if($parentModel){
            $parentId = $parentModel->id; 
            $pages = Contents::model()->findAll(array(
                'select'=>'title,page_seo',
                'condition'=>'parent="'.$parentId.'" AND status=1',
                'order'=>'display_order ASC',
            ));
            return $pages;
        }
    }

    public function getParentId($slug)
    {
    	$parentid = self::model()->findByAttributes(array('page_seo' => $slug))->parent;
    	if($parentid)
    		return self::model()->findByPk(array('parent' => $parentid))->page_seo;
    	else
    		return false;
    }

 //    public function getsubpagemenu($parent,$page)
 //    {
	//     $criteria=new CDbCriteria;
	//     $criteria->condition = 'parent = :parentName and status =:status';
	//     $criteria->params = array(':parentName'=>$parent,':status' =>1);
	//     $criteria->order = 'display_order ASC';
	//     $subpages = self::model()->findAll($criteria); 
	//     $items = array();
	//     if($subpages)
	//     {
	//             foreach($subpages as $subpage)
	//             {
	//               $items[]= array('label'=>($subpage->title), 'url'=>$this->createUrl('/'.$page.'/'.$subpage->page_seo));	            
	//             }
	//             return $items;
	//     }
	// }

	
	    public function getsubpagemenu($parent)
	    {
		    $criteria=new CDbCriteria;
		    $criteria->condition = 'parent = :parentName and status =:status';
		    $criteria->params = array(':parentName'=>$parent,':status' =>1);
		    $criteria->order = 'display_order ASC';
		    $subpages = self::model()->findAll($criteria); 
		    return $subpages;
		}

    public function getcontactsubpagemenu($parent=5,$page='contact')
    {
	    $criteria=new CDbCriteria;
	    $criteria->condition = 'parent = :parentName and status =:status';
	    $criteria->params = array(':parentName'=>$parent,':status' =>1);
	    $criteria->order = 'display_order ASC';
	    $subpages = self::model()->findAll($criteria); 
	    $items = array();
	    $items[]=array('label'=>'Contact Us', 'url'=>$this->createUrl('/'.$page));
	    $items[]=array('label'=>'Where to buy', 'url'=>$this->createUrl('/buy'));
	    if($subpages)
	    {
	            foreach($subpages as $subpage)
	            {
	              $items[]= array('label'=>($subpage->title), 'url'=>$this->createUrl('/'.$page.'/'.$subpage->page_seo));	            
	            }
	          
	    }
	    return $items;
	}

	    public function getcompanysubpagemenu($parent=1,$page='company')
	    {
		    $criteria=new CDbCriteria;
		    $criteria->condition = 'parent = :parentName and status =:status';
		    $criteria->params = array(':parentName'=>$parent,':status' =>1);
		    $criteria->order = 'display_order ASC';
		    $subpages = self::model()->findAll($criteria); 
		    $items = array();
		    $items[]=array('label'=>'Abouts', 'url'=>$this->createUrl('/'.$page.'/about'));
		    $items[]=array('label'=>'Events', 'url'=>$this->createUrl('/events'));
		    if($subpages)
		    {
		            foreach($subpages as $subpage)
		            {
		              $items[]= array('label'=>($subpage->title), 'url'=>$this->createUrl('/'.$page.'/'.$subpage->page_seo));	            
		            }		            
		    }
		   	return $items;
		}
}