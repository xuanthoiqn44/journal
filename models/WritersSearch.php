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


class WritersSearch extends Editor
{
    public $Completed_order;
    public $Status;
    public $Customer_rating;
    public $Skill_Writer;
    public $Writer_id;
    public function rules()
    {
        $rules = [
            [['Status','Completed_order','Skill_Writer','Writer_id'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['Status','Completed_order','Skill_Writer','Writer_id'], 'integer'],
        ];
        return array_merge(parent::rules(),$rules);
        /*return [
                [['Status','Completed_order','Skill_Writer','Writer_id'], 'integer'],
    ];*/
}
    public function search($params) {
        $query = Editor::find()->innerJoinWith('skillWriter', true);
        $pagination_writers = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' =>$query->count(),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination_writers,
        ]);

        $dataProvider->sort = ['defaultOrder' => ['Completed_order' => 'DESC']];
        $dataProvider->sort = ['defaultOrder' => ['Rating' => 'DESC']];
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['>=', 'Completed_order', $this->Completed_order]);
        $query->andFilterWhere(['Status'=> $this->Status,]);
        $query->andFilterWhere(['Chuyen_Nganh'=> $this->Skill_Writer,]);
        $query->andFilterWhere(['editor.id'=> $this->Writer_id,]);
        return $dataProvider;
    }
}