<?php

use PHPUnit\Framework\Attributes\DataProvider;

include_once '/xampp/htdocs/class/helper/FunctionController.php';
include_once '/xampp/htdocs/class/helper/QueryHandler.php';
class EquipmentTest extends \PHPUnit\Framework\TestCase
{
   protected function setUp(): void
   {
      Query::execute("DELETE FROM equipment WHERE id !='1'");
   }

   public static function allEquipmentParams(): array
   {
      return [
         [[], 0],
         [['OSC_083', 'MIC_086', 'TRA_060', 'CIR_003', 'CIR_025', 'CIR_002', 'CIR_052', 'OSC_047', 'TRA_064', 'MIC_064'], 10],
         [['TRA_022', 'OSC_004', 'TRA_039', 'CIR_080', 'CIR_020', 'MIC_030', 'MIC_071', 'MIC_037', 'CIR_037', 'OSC_058', 'TRA_015', 'TRA_071', 'MIC_002', 'CIR_015', 'MIC_057', 'CIR_056', 'OSC_011', 'CIR_025', 'TRA_094', 'TRA_074'], 20],
         [['CIR_094', 'TRA_020', 'CIR_013', 'MIC_014', 'MIC_009', 'MIC_013', 'MIC_094', 'OSC_086', 'CIR_034', 'MIC_090', 'CIR_011', 'OSC_061', 'MIC_082', 'OSC_087', 'CIR_036', 'CIR_096', 'CIR_000', 'CIR_043', 'MIC_071', 'MIC_045', 'TRA_059', 'MIC_089', 'OSC_049', 'OSC_027', 'OSC_069', 'CIR_058', 'MIC_041', 'CIR_052', 'CIR_074', 'CIR_049'], 30],
         [[
            'OSC_095', 'MIC_036', 'CIR_085', 'CIR_077', 'OSC_020', 'MIC_087', 'TRA_071', 'CIR_094', 'OSC_042', 'CIR_083', 'MIC_078', 'MIC_040', 'OSC_098', 'MIC_066', 'CIR_078', 'OSC_089', 'OSC_055', 'CIR_025', 'TRA_061', 'MIC_042', 'CIR_028', 'OSC_084', 'TRA_068', 'CIR_037', 'TRA_095', 'TRA_005', 'TRA_042', 'OSC_052', 'OSC_005', 'TRA_055', 'TRA_006', 'MIC_062', 'TRA_007', 'TRA_030',
            'OSC_013', 'CIR_050', 'TRA_097', 'MIC_091', 'TRA_040', 'TRA_093'
         ], 40],
         [[
            'CIR_078', 'OSC_007', 'OSC_027', 'MIC_029', 'CIR_070', 'TRA_094', 'TRA_081', 'MIC_041', 'MIC_057', 'TRA_016', 'TRA_076', 'MIC_064', 'MIC_028', 'TRA_034', 'TRA_028', 'MIC_034', 'OSC_097', 'TRA_040', 'CIR_025', 'CIR_043', 'OSC_017', 'OSC_062', 'OSC_030', 'CIR_088', 'TRA_027', 'OSC_088', 'MIC_076', 'OSC_024', 'MIC_035', 'MIC_089', 'TRA_058', 'MIC_018', 'OSC_090', 'MIC_078',
            'TRA_004', 'TRA_088', 'CIR_039', 'TRA_010', 'CIR_079', 'OSC_070', 'TRA_000', 'CIR_006', 'OSC_069', 'OSC_048', 'CIR_012', 'OSC_043', 'OSC_087', 'CIR_051', 'TRA_049', 'OSC_081'
         ], 50],
         [[
            'MIC_056', 'CIR_075', 'CIR_005', 'MIC_060', 'CIR_055', 'CIR_074', 'CIR_068', 'OSC_088', 'TRA_034', 'TRA_075', 'CIR_063', 'OSC_023', 'OSC_052', 'MIC_081', 'OSC_039', 'OSC_076', 'CIR_040', 'MIC_035', 'TRA_078', 'CIR_031', 'TRA_037', 'CIR_096', 'TRA_049', 'OSC_075', 'TRA_081', 'MIC_039', 'TRA_028', 'CIR_056', 'TRA_083', 'TRA_024', 'TRA_077', 'MIC_003', 'TRA_016', 'OSC_099',
            'MIC_076', 'OSC_037', 'TRA_068', 'CIR_066', 'CIR_086', 'OSC_047', 'TRA_051', 'TRA_059', 'TRA_063', 'TRA_062', 'OSC_054', 'CIR_090', 'CIR_053', 'CIR_099', 'TRA_057', 'OSC_064', 'TRA_004', 'MIC_019', 'MIC_048', 'TRA_082', 'CIR_016', 'MIC_080', 'OSC_010', 'TRA_031', 'MIC_065', 'TRA_009'
         ], 60],
         [[
            'MIC_076', 'TRA_060', 'MIC_075', 'CIR_023', 'MIC_042', 'TRA_013', 'MIC_023', 'MIC_034', 'MIC_014', 'TRA_095', 'MIC_027', 'TRA_005', 'TRA_065', 'OSC_017', 'CIR_096', 'CIR_034', 'MIC_044', 'CIR_052', 'CIR_003', 'OSC_033', 'CIR_092', 'TRA_064', 'OSC_095', 'OSC_072', 'TRA_027', 'MIC_011', 'CIR_082', 'MIC_046', 'MIC_063', 'TRA_001', 'CIR_031', 'MIC_094', 'MIC_001', 'TRA_094',
            'MIC_084', 'MIC_066', 'CIR_064', 'MIC_089', 'CIR_020', 'CIR_099', 'MIC_068', 'TRA_098', 'MIC_073', 'OSC_085', 'TRA_020', 'CIR_016', 'OSC_077', 'OSC_025', 'OSC_083', 'OSC_055', 'TRA_086', 'MIC_040', 'CIR_078', 'CIR_038', 'CIR_053', 'OSC_016', 'CIR_008', 'OSC_043', 'OSC_094', 'OSC_075', 'CIR_029', 'CIR_032', 'OSC_060', 'OSC_099', 'CIR_013', 'CIR_098', 'CIR_024', 'CIR_067', 'MIC_092', 'MIC_055'
         ], 70],
         [[
            'TRA_071', 'OSC_089', 'MIC_067', 'TRA_030', 'CIR_056', 'TRA_067', 'OSC_067', 'TRA_065', 'TRA_080', 'OSC_098', 'TRA_032', 'CIR_058', 'TRA_029', 'TRA_048', 'MIC_015', 'TRA_078', 'OSC_036', 'OSC_066', 'TRA_010', 'OSC_079', 'MIC_065', 'OSC_037', 'MIC_099', 'MIC_028', 'MIC_005', 'MIC_054', 'MIC_079', 'TRA_049', 'TRA_096', 'TRA_099', 'TRA_083', 'OSC_064', 'MIC_073', 'TRA_082',
            'MIC_006', 'OSC_011', 'OSC_029', 'MIC_096', 'MIC_034', 'CIR_089', 'OSC_069', 'MIC_013', 'TRA_070', 'OSC_047', 'TRA_057', 'MIC_044', 'OSC_088', 'OSC_074', 'OSC_092', 'OSC_005', 'TRA_079', 'TRA_025', 'CIR_077', 'OSC_065', 'CIR_061', 'CIR_083', 'OSC_045', 'TRA_086', 'TRA_084', 'OSC_054', 'CIR_095', 'TRA_042', 'TRA_075', 'CIR_086', 'OSC_084', 'OSC_081', 'MIC_077', 'TRA_001', 'MIC_011', 'TRA_091', 'MIC_030', 'TRA_017', 'OSC_013', 'OSC_090', 'CIR_022', 'OSC_087', 'OSC_022', 'TRA_008', 'TRA_087', 'CIR_096'
         ], 80],
         [[
            'OSC_082', 'MIC_095', 'TRA_023', 'TRA_006', 'OSC_068', 'CIR_008', 'TRA_028', 'MIC_082', 'TRA_086', 'OSC_066', 'CIR_034', 'TRA_003', 'CIR_064', 'CIR_082', 'OSC_000', 'OSC_025', 'CIR_029', 'OSC_005', 'CIR_047', 'OSC_087', 'OSC_038', 'CIR_007', 'CIR_003', 'MIC_061', 'CIR_017', 'MIC_039', 'CIR_016', 'MIC_066', 'CIR_089', 'MIC_052', 'MIC_057', 'MIC_053', 'MIC_045', 'MIC_034',
            'TRA_091', 'OSC_086', 'MIC_071', 'MIC_011', 'MIC_056', 'MIC_040', 'MIC_072', 'MIC_036', 'MIC_026', 'TRA_075', 'CIR_068', 'OSC_099', 'MIC_099', 'MIC_028', 'TRA_081', 'CIR_041', 'OSC_036', 'CIR_021', 'MIC_029', 'MIC_089', 'OSC_007', 'OSC_073', 'TRA_018', 'CIR_048', 'CIR_063', 'OSC_027', 'CIR_028', 'OSC_034', 'CIR_030', 'CIR_019', 'TRA_032', 'MIC_032', 'MIC_027', 'MIC_096', 'TRA_020', 'MIC_070', 'CIR_087', 'MIC_018', 'OSC_030', 'MIC_073', 'OSC_057', 'TRA_068', 'TRA_090', 'MIC_006', 'MIC_086', 'MIC_046', 'MIC_016', 'CIR_095', 'OSC_090', 'MIC_017', 'TRA_019', 'OSC_098', 'TRA_084', 'TRA_016', 'TRA_049', 'TRA_033'
         ], 90],
      ];
   }

   #[DataProvider('allEquipmentParams')]
   public function testAllEquipment(array $equipments, int $expected)
   {
      for ($i = 0; $i < count($equipments); $i++) {
         $equipment = $equipments[$i];
         Query::execute("INSERT INTO equipment VALUES (" . "'TEST','"  . $equipment . "', 0, 2023, 'OK', NULL, NULL, NULL, 1);");
      }
      $this->assertEquals($expected, EquipmentController::getAllEquipments()->rowCount());
   }

   public static function allAvailableEquipmentParams(): array
   {
      return [
         [[], 0],
         [[['TRA_046', 0], ['TRA_096', 1], ['MIC_016', 0], ['OSC_028', 0], ['MIC_001', 0], ['MIC_065', 0], ['CIR_066', 0], ['TRA_054', 0], ['MIC_029', 0], ['TRA_005', 1]], 2],
         [[['MIC_091', 1], ['OSC_015', 0], ['CIR_008', 0], ['CIR_046', 0], ['MIC_028', 1], ['TRA_071', 0], ['MIC_057', 0], ['MIC_081', 1], ['TRA_013', 0], ['MIC_048', 1], ['TRA_019', 0], ['MIC_089', 1], ['CIR_075', 0], ['MIC_041', 1], ['CIR_020', 1], ['MIC_004', 1], ['OSC_045', 1], ['TRA_079', 1], ['MIC_051', 1], ['OSC_049', 0]], 11],
         [[['OSC_073', 1], ['CIR_011', 1], ['TRA_071', 0], ['CIR_020', 1], ['TRA_063', 0], ['OSC_009', 1], ['CIR_015', 0], ['MIC_081', 0], ['OSC_066', 0], ['OSC_047', 1], ['CIR_065', 0], ['CIR_066', 1], ['OSC_002', 0], ['MIC_063', 0], ['MIC_034', 0], ['TRA_040', 0], ['MIC_077', 0], ['MIC_056', 0], ['CIR_087', 1], ['OSC_033', 1], ['MIC_037', 1], ['MIC_083', 1], ['OSC_049', 0], ['OSC_014', 0], ['TRA_081', 0], ['OSC_048', 0], ['TRA_037', 1], ['TRA_022', 1], ['CIR_001', 0], ['OSC_043', 1]], 13],
         [[['MIC_076', 1], ['OSC_084', 0], ['MIC_046', 0], ['CIR_010', 1], ['TRA_041', 1], ['MIC_055', 1], ['OSC_087', 0], ['TRA_059', 0], ['MIC_083', 0], ['TRA_029', 0], ['MIC_038', 1], ['MIC_037', 0], ['TRA_028', 0], ['CIR_008', 1], ['OSC_030', 1], ['MIC_084', 1], ['TRA_098', 1], ['MIC_064', 1], ['MIC_034', 0], ['MIC_013', 0], ['OSC_082', 1], ['MIC_052', 1], ['MIC_008', 0], ['CIR_046', 1], ['TRA_025', 0], ['CIR_075', 1], ['CIR_091', 0], ['TRA_010', 0], ['OSC_039', 1], ['CIR_019', 1], ['OSC_020', 0], ['OSC_050', 1], ['OSC_017', 0], ['OSC_099', 1], ['OSC_079', 0], ['MIC_035', 1], ['MIC_010', 1], ['CIR_090', 1], ['CIR_055', 1], ['OSC_015', 0]], 22],
         [[['OSC_048', 1], ['TRA_046', 1], ['MIC_061', 1], ['CIR_071', 0], ['TRA_078', 0], ['TRA_055', 0], ['MIC_008', 0], ['OSC_049', 0], ['TRA_074', 0], ['CIR_044', 1], ['CIR_024', 1], ['OSC_017', 1], ['OSC_008', 1], ['CIR_032', 0], ['OSC_007', 1], ['MIC_079', 1], ['TRA_059', 0], ['OSC_031', 1], ['OSC_099', 0], ['TRA_003', 0], ['OSC_020', 0], ['TRA_009', 0], ['MIC_042', 1], ['TRA_085', 0], ['MIC_058', 1], ['MIC_092', 0], ['TRA_088', 0], ['MIC_040', 1], ['TRA_033', 0], ['MIC_062', 1], ['CIR_005', 0], ['MIC_039', 0], ['MIC_053', 1], ['CIR_065', 0], ['OSC_085', 0], ['TRA_029', 0], ['MIC_013', 0], ['TRA_018', 1], ['CIR_082', 1], ['CIR_015', 0], ['CIR_048', 1], ['MIC_035', 0], ['TRA_083', 1], ['OSC_005', 0], ['TRA_091', 0], ['MIC_009', 0], ['CIR_010', 0], ['MIC_048', 1], ['MIC_021', 1], ['OSC_095', 1]], 22],
         [[['TRA_005', 1], ['TRA_029', 1], ['MIC_034', 1], ['OSC_006', 1], ['TRA_063', 0], ['MIC_053', 0], ['OSC_097', 0], ['OSC_021', 0], ['MIC_027', 1], ['TRA_053', 1], ['CIR_025', 1], ['MIC_052', 0], ['TRA_080', 0], ['TRA_079', 1], ['CIR_040', 1], ['MIC_094', 0], ['TRA_011', 1], ['CIR_058', 0], ['MIC_010', 0], ['TRA_032', 1], ['MIC_085', 0], ['TRA_059', 1], ['TRA_034', 1], ['TRA_040', 0], ['CIR_072', 0], ['OSC_010', 1], ['TRA_046', 1], ['OSC_003', 0], ['OSC_042', 0], ['CIR_047', 1], ['CIR_095', 0], ['TRA_072', 0], ['OSC_068', 1], ['CIR_089', 1], ['TRA_099', 0], ['OSC_087', 1], ['MIC_089', 1], ['CIR_007', 1], ['CIR_093', 0], ['MIC_009', 1], ['MIC_014', 0], ['CIR_002', 0], ['OSC_089', 1], ['CIR_099', 0], ['MIC_021', 0], ['CIR_037', 1], ['CIR_067', 0], ['OSC_092', 0], ['CIR_056', 0], ['CIR_026', 1], ['MIC_040', 1], ['OSC_062', 0], ['TRA_078', 0], ['TRA_039', 1], ['TRA_026', 1], ['TRA_036', 0], ['TRA_096', 0], ['MIC_098', 1], ['OSC_077', 1], ['MIC_084', 0]], 30],
         [[
            ['CIR_085', 0], ['OSC_019', 1], ['OSC_033', 0], ['OSC_054', 0], ['OSC_023', 0], ['OSC_086', 1], ['MIC_032', 0], ['TRA_054', 1], ['MIC_070', 0], ['CIR_068', 1], ['MIC_065', 1], ['TRA_063', 0], ['CIR_034', 1], ['TRA_033', 0], ['OSC_046', 0], ['TRA_093', 1], ['CIR_011', 1], ['TRA_064', 0], ['OSC_075', 0], ['CIR_017', 0], ['MIC_039', 1], ['TRA_029', 0], ['TRA_059', 0], ['MIC_071', 1], ['TRA_021', 0], ['TRA_068', 1], ['CIR_089', 1], ['TRA_070', 0], ['CIR_070', 0], ['OSC_002', 0], ['CIR_044', 0], ['CIR_052', 1], ['TRA_016', 1], ['OSC_077', 0], ['MIC_041', 0], ['MIC_049', 0], ['MIC_097', 1], ['OSC_021', 0], ['MIC_006', 1], ['OSC_078', 0], ['MIC_018', 0], ['OSC_031', 0], ['CIR_037', 0], ['TRA_090', 1], ['OSC_035', 0], ['TRA_079', 1], ['MIC_055', 0], ['TRA_067', 0], ['TRA_083', 0], ['MIC_050', 0], ['CIR_057', 1], ['CIR_073', 0], ['OSC_018', 1], ['MIC_024', 0], ['CIR_095', 1], ['OSC_059', 0], ['CIR_054', 1], ['MIC_025', 0], ['CIR_080', 0], ['CIR_040', 1], ['OSC_072', 0], ['MIC_043', 0], ['MIC_058', 0], ['OSC_047', 0],
            ['TRA_099', 1], ['OSC_069', 1], ['CIR_031', 0], ['CIR_059', 1], ['CIR_035', 0], ['TRA_062', 1]
         ], 27],
         [[
            ['TRA_007', 0], ['OSC_014', 1], ['OSC_000', 1], ['TRA_043', 0], ['OSC_071', 0], ['MIC_022', 1], ['OSC_018', 0], ['CIR_014', 1], ['MIC_005', 0], ['MIC_066', 1], ['MIC_017', 1], ['CIR_025', 0], ['MIC_024', 0], ['OSC_022', 1], ['MIC_029', 0], ['OSC_019', 1], ['MIC_045', 0], ['OSC_034', 0], ['OSC_092', 0], ['OSC_006', 1], ['CIR_000', 0], ['CIR_064', 0], ['CIR_057', 0], ['TRA_034', 0], ['CIR_031', 1], ['OSC_054', 0], ['CIR_054', 1], ['TRA_065', 1], ['TRA_015', 1], ['MIC_053', 0], ['MIC_094', 0], ['CIR_016', 0], ['OSC_085', 0], ['CIR_086', 1], ['CIR_049', 1], ['MIC_079', 1], ['MIC_082', 1], ['OSC_011', 0], ['OSC_012', 0], ['CIR_001', 1], ['MIC_031', 1], ['TRA_014', 0], ['CIR_044', 0], ['CIR_013', 0], ['OSC_052', 0], ['CIR_074', 1], ['MIC_032', 0], ['OSC_078', 0], ['MIC_070', 1], ['OSC_061', 1], ['OSC_029', 0], ['OSC_028', 1], ['CIR_052', 0], ['MIC_072', 0], ['MIC_044', 0], ['TRA_027', 1], ['MIC_097', 0], ['CIR_034', 1], ['TRA_006', 0], ['TRA_022', 0], ['TRA_032', 1], ['OSC_075', 0], ['CIR_097', 0], ['OSC_086', 0],
            ['OSC_073', 0], ['OSC_062', 0], ['TRA_064', 0], ['MIC_063', 0], ['OSC_001', 1], ['OSC_094', 0], ['OSC_056', 1], ['MIC_071', 1], ['OSC_088', 0], ['MIC_060', 0], ['CIR_026', 0], ['MIC_038', 0], ['OSC_024', 1], ['TRA_025', 1], ['TRA_052', 0], ['TRA_021', 1]
         ], 32],
         [[
            ['TRA_057', 0], ['OSC_028', 1], ['CIR_040', 1], ['MIC_079', 1], ['CIR_035', 1], ['TRA_058', 0], ['OSC_014', 0], ['TRA_088', 0], ['MIC_007', 1], ['MIC_090', 0], ['MIC_024', 0], ['OSC_080', 1], ['CIR_081', 0], ['CIR_054', 0], ['OSC_058', 1], ['TRA_074', 0], ['CIR_039', 1], ['OSC_019', 1], ['OSC_090', 1], ['OSC_047', 0], ['TRA_024', 0], ['OSC_098', 0], ['CIR_008', 0], ['TRA_082', 1], ['MIC_054', 1], ['TRA_009', 0], ['OSC_077', 1], ['MIC_080', 0], ['MIC_059', 1], ['CIR_071', 0], ['TRA_035', 1], ['TRA_085', 0], ['TRA_080', 0], ['OSC_088', 0], ['CIR_072', 1], ['OSC_038', 0], ['MIC_047', 1], ['OSC_087', 1], ['TRA_062', 0], ['CIR_096', 1], ['OSC_096', 0], ['TRA_052', 1], ['MIC_053', 1], ['OSC_012', 1], ['CIR_049', 1], ['OSC_036', 1], ['MIC_043', 0], ['OSC_099', 1], ['CIR_050', 0], ['MIC_032', 1], ['MIC_041', 0], ['TRA_097', 0], ['CIR_024', 0], ['TRA_096', 0], ['TRA_067', 1], ['OSC_006', 1], ['CIR_062', 1], ['CIR_004', 0], ['MIC_031', 1], ['MIC_025', 1], ['TRA_011', 1], ['TRA_047', 0], ['TRA_033', 0], ['TRA_099', 0],
            ['TRA_002', 0], ['CIR_065', 0], ['TRA_051', 1], ['MIC_058', 1], ['CIR_056', 0], ['TRA_010', 0], ['MIC_074', 0], ['MIC_022', 1], ['CIR_061', 0], ['CIR_032', 0], ['MIC_016', 0], ['TRA_016', 0], ['MIC_015', 1], ['MIC_000', 0], ['TRA_022', 0], ['CIR_019', 0], ['CIR_000', 0], ['CIR_079', 0], ['MIC_038', 0], ['TRA_049', 1], ['OSC_003', 1], ['TRA_031', 1], ['TRA_093', 0], ['TRA_078', 0], ['OSC_045', 1], ['OSC_056', 0]
         ], 40],
      ];
   }

   #[DataProvider('allAvailableEquipmentParams')]
   public function testAllAvailableEquipment(array $equipments, int $expected)
   {
      for ($i = 0; $i < count($equipments); $i++) {
         $equipmentInfo = $equipments[$i];
         Query::execute("INSERT INTO equipment VALUES (" . "'TEST','"  . $equipmentInfo[0] . "', 0, 2023, 'OK', NULL, NULL, NULL, " . $equipmentInfo[1] . ");");
      }
      $this->assertEquals($expected, EquipmentController::getAllAvailableEquipments()->rowCount());
   }

   public static function findEquipmentParams(): array
   {
      return [
         [['TRA_015', 'CIR_011', 'TRA_043', 'MIC_092', 'CIR_098', 'MIC_012', 'CIR_069', 'MIC_014', 'CIR_012', 'MIC_082'], 'CIR_012', true],
         [['OSC_004', 'TRA_048', 'TRA_031', 'CIR_097', 'OSC_071', 'MIC_040', 'OSC_031', 'MIC_055', 'TRA_006', 'MIC_052', 'TRA_083', 'MIC_096', 'TRA_065', 'OSC_040', 'CIR_068', 'CIR_025', 'CIR_070', 'CIR_018', 'MIC_027', 'TRA_074'], 'OSC_061', false],
         [['CIR_001', 'TRA_042', 'OSC_005', 'OSC_055', 'CIR_055', 'MIC_023', 'TRA_006', 'MIC_059', 'TRA_036', 'CIR_093', 'OSC_047', 'OSC_039', 'MIC_055', 'TRA_080', 'CIR_040', 'MIC_064', 'OSC_060', 'OSC_033', 'CIR_046', 'CIR_006', 'MIC_065', 'CIR_021', 'OSC_095', 'TRA_028', 'MIC_024', 'CIR_038', 'OSC_069', 'MIC_066', 'TRA_009', 'OSC_087'], 'MIC_065', true],
         [[
            'CIR_066', 'OSC_021', 'CIR_072', 'CIR_097', 'OSC_063', 'CIR_051', 'CIR_022', 'MIC_076', 'MIC_006', 'CIR_060', 'TRA_007', 'TRA_083', 'OSC_075', 'OSC_008', 'MIC_085', 'TRA_088', 'OSC_001', 'MIC_080', 'CIR_057', 'CIR_082', 'CIR_031', 'OSC_040', 'OSC_083', 'OSC_082', 'OSC_088', 'MIC_066', 'OSC_016', 'MIC_053', 'TRA_035', 'MIC_097', 'TRA_086', 'CIR_079', 'OSC_093', 'OSC_095',
            'TRA_099', 'CIR_071', 'CIR_080', 'CIR_000', 'TRA_059', 'TRA_070'
         ], 'TRA_070', true],
         [
            [
               'TRA_031', 'MIC_062', 'OSC_051', 'MIC_020', 'TRA_022', 'CIR_087', 'CIR_005', 'CIR_059', 'TRA_071', 'TRA_046', 'MIC_060', 'MIC_080', 'TRA_050', 'OSC_093', 'MIC_019', 'CIR_080', 'MIC_090', 'TRA_014', 'CIR_077', 'CIR_070', 'OSC_086', 'CIR_044', 'OSC_087', 'TRA_023', 'OSC_004', 'MIC_075', 'TRA_016', 'MIC_086', 'OSC_011', 'TRA_067', 'OSC_039', 'TRA_060', 'MIC_093', 'MIC_018',
               'OSC_057', 'TRA_089', 'TRA_007', 'CIR_083', 'CIR_066', 'OSC_002', 'CIR_081', 'MIC_072', 'TRA_083', 'TRA_080', 'CIR_025', 'OSC_025', 'CIR_065', 'CIR_019', 'CIR_007', 'MIC_052'
            ], 'MIC_091',
            false
         ],
         [[
            'OSC_078', 'CIR_059', 'TRA_077', 'OSC_011', 'MIC_071', 'CIR_031', 'MIC_080', 'TRA_031', 'CIR_066', 'TRA_022', 'OSC_012', 'CIR_046', 'OSC_058', 'CIR_032', 'MIC_096', 'TRA_095', 'TRA_076', 'CIR_044', 'MIC_064', 'OSC_076', 'MIC_057', 'OSC_077', 'TRA_014', 'MIC_052', 'TRA_038', 'TRA_094', 'CIR_088', 'CIR_010', 'CIR_049', 'MIC_078', 'OSC_016', 'MIC_026', 'MIC_003', 'TRA_021',
            'MIC_075', 'OSC_062', 'CIR_042', 'CIR_092', 'OSC_014', 'MIC_022', 'TRA_088', 'CIR_077', 'OSC_036', 'CIR_022', 'CIR_041', 'MIC_086', 'OSC_091', 'OSC_045', 'TRA_056', 'MIC_044', 'OSC_010', 'OSC_087', 'CIR_099', 'OSC_003', 'MIC_000', 'OSC_054', 'OSC_029', 'OSC_074', 'MIC_065', 'MIC_095'
         ], 'OSC_051', false],
         [[
            'CIR_003', 'CIR_017', 'OSC_009', 'OSC_074', 'OSC_001', 'OSC_028', 'CIR_078', 'CIR_089', 'OSC_068', 'OSC_063', 'TRA_051', 'CIR_037', 'CIR_096', 'MIC_045', 'OSC_057', 'TRA_022', 'CIR_075', 'TRA_004', 'CIR_064', 'MIC_069', 'CIR_011', 'CIR_033', 'CIR_074', 'CIR_073', 'CIR_010', 'CIR_072', 'TRA_010', 'MIC_002', 'MIC_041', 'OSC_037', 'TRA_000', 'MIC_036', 'OSC_069', 'OSC_083',
            'TRA_080', 'MIC_085', 'MIC_003', 'MIC_084', 'TRA_095', 'MIC_001', 'TRA_045', 'MIC_046', 'CIR_059', 'OSC_030', 'OSC_048', 'TRA_069', 'OSC_019', 'CIR_021', 'MIC_096', 'MIC_020', 'MIC_074', 'OSC_089', 'MIC_042', 'OSC_015', 'CIR_063', 'MIC_053', 'TRA_076', 'OSC_023', 'OSC_005', 'TRA_048', 'CIR_093', 'TRA_053', 'OSC_038', 'MIC_093', 'CIR_004', 'OSC_087', 'CIR_007', 'OSC_039', 'TRA_040', 'TRA_039'
         ], 'CIR_082', false],
         [[
            'MIC_028', 'TRA_079', 'CIR_025', 'TRA_094', 'MIC_040', 'CIR_004', 'MIC_088', 'TRA_012', 'OSC_040', 'CIR_055', 'CIR_056', 'MIC_075', 'OSC_011', 'OSC_091', 'CIR_034', 'MIC_030', 'TRA_043', 'CIR_010', 'MIC_066', 'MIC_013', 'CIR_012', 'CIR_033', 'MIC_033', 'OSC_080', 'TRA_040', 'OSC_045', 'MIC_025', 'CIR_036', 'MIC_081', 'MIC_049', 'CIR_078', 'CIR_005', 'TRA_030', 'OSC_030',
            'TRA_060', 'CIR_000', 'MIC_090', 'OSC_095', 'OSC_007', 'MIC_018', 'TRA_052', 'OSC_021', 'TRA_067', 'CIR_030', 'MIC_098', 'MIC_016', 'CIR_053', 'TRA_080', 'MIC_056', 'TRA_033', 'CIR_082', 'TRA_056', 'OSC_039', 'TRA_069', 'TRA_007', 'CIR_067', 'OSC_099', 'OSC_004', 'CIR_018', 'MIC_042', 'TRA_058', 'MIC_007', 'OSC_061', 'CIR_017', 'MIC_079', 'TRA_016', 'TRA_020', 'CIR_062', 'CIR_014', 'TRA_036', 'TRA_097', 'OSC_034', 'MIC_008', 'TRA_009', 'OSC_064', 'OSC_031', 'TRA_046', 'MIC_027', 'TRA_003', 'CIR_050'
         ], 'OSC_079', false],
         [[
            'OSC_009', 'TRA_066', 'OSC_018', 'TRA_099', 'CIR_027', 'MIC_065', 'MIC_060', 'OSC_001', 'MIC_086', 'CIR_051', 'TRA_022', 'TRA_001', 'OSC_030', 'MIC_077', 'CIR_042', 'MIC_044', 'OSC_069', 'CIR_050', 'OSC_037', 'CIR_080', 'CIR_092', 'MIC_024', 'OSC_061', 'OSC_064', 'OSC_079', 'CIR_078', 'TRA_024', 'CIR_004', 'CIR_016', 'MIC_017', 'TRA_043', 'OSC_096', 'OSC_012', 'OSC_094',
            'TRA_087', 'CIR_003', 'OSC_083', 'MIC_047', 'MIC_003', 'MIC_067', 'TRA_041', 'TRA_017', 'OSC_039', 'OSC_002', 'MIC_058', 'MIC_095', 'CIR_095', 'CIR_065', 'OSC_046', 'OSC_021', 'OSC_076', 'OSC_057', 'CIR_086', 'MIC_021', 'OSC_092', 'TRA_088', 'TRA_074', 'OSC_091', 'OSC_051', 'CIR_097', 'CIR_088', 'CIR_070', 'TRA_006', 'TRA_011', 'OSC_010', 'TRA_059', 'CIR_019', 'OSC_028', 'OSC_023', 'TRA_065', 'OSC_015', 'MIC_051', 'CIR_077', 'OSC_071', 'OSC_054', 'OSC_090', 'OSC_081', 'CIR_039', 'OSC_082', 'MIC_035', 'CIR_049', 'TRA_037', 'CIR_033', 'TRA_045', 'CIR_079', 'CIR_082', 'TRA_031', 'TRA_016', 'MIC_097', 'OSC_099'
         ], 'OSC_026', false],
      ];
   }
   #[DataProvider('findEquipmentParams')]
   public function testFindAvailableEquipment(array $equipments, string $needFind, bool $expected)
   {
      for ($i = 0; $i < count($equipments); $i++) {
         $equipment = $equipments[$i];
         Query::execute("INSERT INTO equipment VALUES (" . "'TEST','"  . $equipment . "', 0, 2023, 'OK', NULL, NULL, NULL, 1);");
      }
      $this->assertEquals($expected, EquipmentController::getEquipmentByID($needFind)->rowCount() != 0);
   }
}
