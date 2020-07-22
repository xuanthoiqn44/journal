<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/23/2018
 * Time: 11:47 PM
 */

namespace app\models;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;


class AllPostSearch extends Post
{
    public $Id;
    //public $Topic;
    public $Token_Order;
    public $Author_Name;
    public $Date_Create;
    public $Dead_Line;
    public $Status;
    public function rules()
    {
        $rules = [
            [['Token_Order','Id','Author_Name','Status','Date_Create'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['Id'], 'integer'],
        ];
        return array_merge(parent::rules(),$rules);
        /*return [
                [['Status','Completed_order','Skill_Writer','Writer_id'], 'integer'],
    ];*/
}
    public function search($params) {
        //$query = Editor::find()->innerJoinWith('skillWriter', true);
        $query = Post::find()->innerJoinWith('user',true);

        $pagination_writers = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' =>$query->count(),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query->with('user'),
            'pagination' => $pagination_writers,
        ]);

        $dataProvider->sort = ['defaultOrder' => ['Status_Sort' => 'DESC']];
        //$dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
        //$dataProvider->sort = ['defaultOrder' => ['Date_Create' => 'DESC']];
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }
        //$query->andFilterWhere(['>=', 'Completed_order', $this->Completed_order]);
        $query->andFilterWhere(['post.id'=> $this->Id]);
        $query->andFilterWhere(['like','Token_Order',$this->Token_Order,]);
        $query->andFilterWhere(['like','post.Status',$this->Status,]);
        $query->andFilterWhere(['like','post.Date_Create',$this->Date_Create,]);
        //$query->andFilterWhere(['editor.id'=> $this->Writer_id,]);
        return $dataProvider;
    }
}