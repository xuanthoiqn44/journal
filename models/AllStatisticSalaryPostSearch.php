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


class AllStatisticSalaryPostSearch extends Post
{
    public $Id;
    //public $Topic;
    public $Id_User;
    public $Id_Editor;
    public $Date_Create;
    public $Dead_Line;
    public $Date_Edit;
    public $Date_Finish;
    public function rules()
    {
        $rules = [
            [['Id_User','Id','Id_Editor','Date_Create','Dead_Line','Date_Edit','Date_Finish'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['Id','Id_User','Id_Editor'], 'integer'],
        ];
        return array_merge(parent::rules(),$rules);
        /*return [
                [['Status','Completed_order','Skill_Writer','Writer_id'], 'integer'],
    ];*/
}
    public function search($params) {

        $query = Post::find()
            //->where(['<=','Date_Finish',date('Y-m-d H:i:s')])
            //->where(['>=','Date_Finish',date('Y-m-d H:i:s',strtotime("-7days"))])
            ->where(['post.Status'=>"Completed",'Status_Salary_Editor'=>"Yes"])
            ->innerJoinWith(['user','editors','feedback'],true);
        $pagination_writers = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' =>$query->count(),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query->with('user'),
            'pagination' => $pagination_writers,
        ]);

        $dataProvider->sort = ['defaultOrder' => ['Date_Finish' => 'DESC']];
        //$dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
        //$dataProvider->sort = ['defaultOrder' => ['Date_Create' => 'DESC']];
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['post.id'=> $this->Id]);
        $query->andFilterWhere(['like','post.Date_Create',$this->Date_Create]);
        $query->andFilterWhere(['like','post.Dead_Line',$this->Dead_Line]);
        $query->andFilterWhere(['like','post.Date_Edit',$this->Date_Edit]);
        $query->andFilterWhere(['like','post.Date_Completed',$this->Date_Finish]);
        $query->andFilterWhere(['user.id'=> $this->Id_User]);
        //$query->joinWith('editors');
        $query->andFilterWhere(['editor.id'=> $this->Id_Editor]);
        return $dataProvider;
    }
}