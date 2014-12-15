<?php
/**
 * RbacManager is a command-line tool (extends CConsoleCommand) for managing rbac items and assignments.
 * @author wapmorgan (wapmorgan@gmail.com)
 * @param string $modelClass AR model that represent users in db
 */
class UtilityCommand extends CConsoleCommand {
	public function actionImport()
        {
            foreach (User::model()->with('profile')->findAll() as $user)
            {
                if ($user->profile)
                {
                    $designation=  Designation::getDesignationModelByUser($user->id);
                    if ($designation)
                    {
                        $designation->officer_name=$user->profile->firstname.' '.$user->profile->lastname;
                        $designation->officer_mobile=$user->profile->mobile;
                        $designation->save();
                    }
                }
            }
                
        }
        public function actionPdf($outdir,$offr=false)
        {
            $pdfwriter=new PdfWriter;
            $rows=array();
             if ($offr!=false)
                $rows[0]['officerassigned']=$offr;
             else 
             {
            $sql = "select * from (select officerassigned,count(*) as count1 from landdisputes  where status=0  group by officerassigned) t1 where t1.count1>0";
           
            $rows=Yii::app()->db->createCommand($sql)->queryAll();
             }
       //print($rows)
            foreach ($rows as $row )
            {
              $pdfwriter->printPendingLanddisputes($row['officerassigned'],$outdir);
              $pdfwriter->printPendingComplaints($row['officerassigned'],$outdir);
            }
        }
}
