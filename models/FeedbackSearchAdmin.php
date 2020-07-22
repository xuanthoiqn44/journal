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


class FeedbackSearchAdmin extends Post
{
    public $Id_Order;
    public $Date_Time;
    public $Rate;
    public function rules()
    {
        $rules = [
            [['Id_Order','Date_Time','Rate'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['Id_Order','Rate'], 'integer'],
        ];
        return array_merge(parent::rules(),$rules);
        /*return [
                [['Status','Completed_order','Skill_Writer','Writer_id'], 'integer'],
    ];*/
}
    public function search($params) {
        $query = Feedback::find()
            //->innerJoinWith(['user'],true)
            ->with('post.editors')
            ->with('post.user');
        $pagination_writers = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' =>$query->count(),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination_writers,
        ]);

        $dataProvider->sort = ['defaultOrder' => ['Date_Time' => 'DESC']];
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }
        //$query->andFilterWhere(['>=', 'Completed_order', $this->Completed_order]);
        //$query->andFilterWhere(['feedback.Id'=> $this->Id]);
        $query->andFilterWhere(['feedback.Id_Order'=>$this->Id_Order,]);
        //$query->andFilterWhere(['feedback.Id_User'=>$this->Id_User,]);
        $query->andFilterWhere(['like','feedback.Date_Time',$this->Date_Time,]);
        //$query->andFilterWhere(['editor.id'=> $this->Writer_id,]);
        return $dataProvider;
    }
}